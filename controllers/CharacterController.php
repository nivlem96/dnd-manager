<?php

namespace app\controllers;

use app\models\Character;
use app\models\ClassRelation;
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
                if ($attributes = Yii::$app->request->post('ClassRelation')) {
                    $classData = [
                        'character_id' => Yii::$app->db->getLastInsertID(),
                        'class_id' => $attributes['class_id'],
                    ];
                    $this->saveClassRelation($classData);
                }
                return $this->actionIndex();
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
        if(!empty($data['id'])) {
            $relationModel = ClassRelation::findOne($data['id']);
        }
        if($relationModel == null) {
            $relationModel = new ClassRelation();
        }
        foreach ($data as $key=>$value) {
            $relationModel->$key = $value;
        }
        if ($relationModel->validate()) {
            $relationModel->save();
        }
    }

}
