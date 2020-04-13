<?php

namespace app\controllers;

use app\models\Character;
use app\models\CharacterClass;
use app\models\ClassRelation;
use app\models\FeatRelation;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class CharacterController extends \yii\web\Controller {
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $User = new User();
        $dataProvider = new ActiveDataProvider([
            'query' => $User->findOne(Yii::$app->user->id)->getCharacters(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @var User      $User
     * @var Character $model
     *
     * @return string|Response
     */
    public function actionCreate($campaign_id = null) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Character();
        if ($attributes = Yii::$app->request->post('Character')) {
            if ($classAttributes = Yii::$app->request->post('ClassRelation')) {
                $attributes['campaign_id'] = $campaign_id;
                $model->setAttributes($attributes);
                $class = CharacterClass::findOne($classAttributes['class_id']);
                $model->max_hitpoints = $class->hitdice + $model->getStatModifier($model->constitution);
                $model->current_hitpoints = $model->max_hitpoints;
                if ($model->validate()) {
                    $model->save();
                    $id = Yii::$app->db->getLastInsertID();
                    $classData = [
                        'character_id' => $id,
                        'class_id' => $classAttributes['class_id'],
                    ];
                    $this->saveClassRelation($classData);
                    $this->saveFeatRelation($id);
                    return $this->goBack(['/character/view', 'id' => $id]);
                } else {
                    var_dump($model->getErrors());
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @var User      $User
     * @var Character $model
     *
     * @return string|Response
     */
    public function actionEdit($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = Character::find()->where(['id' => $id])->one();
        if ($attributes = Yii::$app->request->post('Character')) {
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                return $this->goBack(['/character/view', 'id' => $id]);
            } else {
                var_dump($model->getErrors());
            }
        }
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * @param         $id
     *
     * @var Character $model
     *
     * @return string|Response
     */
    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Character = new Character();
        $user = User::findIdentity(Yii::$app->user->id);
        $model = $Character->findOne($id);
        return $this->render('view', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * @param         $id
     *
     * @var Character $model
     *
     * @return string|Response
     */
    public function actionLevelUp($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if ($attributes = Yii::$app->request->post('ClassRelation')) {
            $classData = [
                'character_id' => $id,
                'class_id' => $attributes['class_id'],
            ];
            $this->saveClassRelation($classData);
            $this->goBack(['character/level-up-confirmation', 'characterId' => $id, 'classId' => $attributes['class_id']]);
        }
        $Character = new Character();
        $user = User::findIdentity(Yii::$app->user->id);
        $model = $Character->findOne($id);
        return $this->render('level-up', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * @param $classId
     * @param $characterId
     *
     * @return string|Response
     */
    public function actionLevelUpClass($classId, $characterId) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Character = new Character();
        $model = $Character->findOne($characterId);
        $model->level = $model->level + 1;
        $model->save();
        $classRelation = $model->getClassRelation();
        if ($relation = $classRelation->where(['=', 'class_id', $classId])->one()) {
            $relation->level = $relation->level + 1;
            $relation->save();
        }
        $this->goBack(['character/level-up-confirmation', 'characterId' => $characterId, 'classId' => $classId]);

    }

    /**
     * @param $classId
     * @param $characterId
     *
     * @return string|Response
     */
    public function actionLevelUpConfirmation($characterId, $classId) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Character = Character::findOne($characterId);
        if ($attributes = Yii::$app->request->post('Character')) {
            $addNumber = $attributes['dice'] + $Character->getStatModifier($Character->constitution) > 1 ? $attributes['dice'] + $Character->getStatModifier($Character->constitution) : 1;
            $Character->max_hitpoints += $addNumber;
            $Character->current_hitpoints += $addNumber;
            $Character->save();
            $this->goBack(['/character/view', 'id' => $characterId]);
        } else {
            $classRelation = $Character->getClassRelation()->where(['class_id'=>$classId])->one();
            $class = $classRelation->class;
            $model = $Character->findOne($characterId);
            $user = User::findIdentity(Yii::$app->user->id);
            $availableFeats = $this->saveFeatRelation($characterId);
            return $this->render('level-up-confirmation', [
                'model' => $model,
                'class' => $class,
                'user' => $user,
                'availableFeats' => $availableFeats,
            ]);
        }
    }

    public function actionDelete($id) {
        $Character = new Character();
        try {
            ClassRelation::deleteAll(['character_id' => $id]);
            $Character->findOne($id)->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }
        return $this->goBack(['/character']);
    }

    private function saveClassRelation(array $data) {
        $relationModel = null;
        if (!empty($data['id'])) {
            $relationModel = ClassRelation::findOne($data['id']);
        }
        if ($relationModel == null) {
            $relationModel = new ClassRelation();
        }
        foreach ($data as $key => $value) {
            $relationModel->$key = $value;
        }
        if ($relationModel->validate()) {
            $relationModel->save();
        }
        return;
    }

    private function saveFeatRelation($characterId) {
        $availableFeats = Character::getLevelUpFeats($characterId);
        foreach ($availableFeats as $key => $feat) {
            $attributes = FeatRelation::find()->where(['character_id' => $characterId])->andWhere(['feat_id' => $feat->id])->all();
            if (empty($attributes)) {
                $featRelation = new FeatRelation();
                $featRelation->feat_id = $feat->id;
                $featRelation->character_id = $characterId;
                $featRelation->class_id = $feat->class_id;
                $featRelation->race_id = $feat->race_id;
                $featRelation->save();
            } else {
                unset($availableFeats[$key]);
            }
        }
        return $availableFeats;
    }

}
