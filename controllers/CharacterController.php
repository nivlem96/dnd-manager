<?php

namespace app\controllers;

use app\models\Character;
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
            $attributes['campaign_id'] = $campaign_id;
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                $id = Yii::$app->db->getLastInsertID();
                if ($attributes = Yii::$app->request->post('ClassRelation')) {
                    $classData = [
                        'character_id' => $id,
                        'class_id' => $attributes['class_id'],
                    ];
                    $this->saveClassRelation($classData);
                }
                $availableFeats = Character::getLevelUpFeats($id);
                foreach ($availableFeats as $key => $feat) {
                    $attributes = FeatRelation::find()->where(['character_id'=>$id])->andWhere(['feat_id'=>$feat->id])->all();
                    if(empty($attributes)) {
                        $featRelation = new FeatRelation();
                        $featRelation->feat_id = $feat->id;
                        $featRelation->character_id = $id;
                        $featRelation->class_id = $feat->class_id;
                        $featRelation->race_id = $feat->race_id;
                        $featRelation->save();
                    } else {
                        unset($availableFeats[$key]);
                    }
                }
                return $this->goBack(['/character/view', 'id' => $id]);
            } else {
                var_dump($model->getErrors());
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
            $this->goBack(['character/level-up-confirmation', 'id' => $id]);
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
        $this->goBack(['character/level-up-confirmation', 'id' => $characterId]);

    }

    /**
     * @param $classId
     * @param $characterId
     *
     * @return string|Response
     */
    public function actionLevelUpConfirmation($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if ($attributes = Yii::$app->request->post('ClassRelation')) {
            $this->goBack(['/character/view','id'=>$id]);
        }else {
            $Character = new Character();
            $model = $Character->findOne($id);
            $user = User::findIdentity(Yii::$app->user->id);
            $availableFeats = Character::getLevelUpFeats($id);
            foreach ($availableFeats as $key => $feat) {
                $attributes = FeatRelation::find()->where(['character_id'=>$id])->andWhere(['feat_id'=>$feat->id])->all();
                if(empty($attributes)) {
                    $featRelation = new FeatRelation();
                    $featRelation->feat_id = $feat->id;
                    $featRelation->character_id = $id;
                    $featRelation->class_id = $feat->class_id;
                    $featRelation->race_id = $feat->race_id;
                    $featRelation->save();
                } else {
                    unset($availableFeats[$key]);
                }
            }
            return $this->render('level-up-confirmation', [
                'model' => $model,
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

}
