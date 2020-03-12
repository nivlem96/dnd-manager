<?php

namespace app\controllers;

use app\models\Race;
use app\models\User;
use Yii;
use yii\web\Response;

class RaceController extends \yii\web\Controller {
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Race = new Race();
        $user = new User(Yii::$app->user->id);
        $model = $Race->getUserAvailableRaces(Yii::$app->user->id);
        return $this->render('index', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * @var User $User
     * @var Race $model
     *
     * @return string|Response
     */
    public function actionCreate() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Race();
        if ($attributes = Yii::$app->request->post('Race')) {
            $attributes['created_by_user_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                return $this->goBack(['/race']);
            } else {
                var_dump($model->getErrors());
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param        $id
     *
     * @var Race     $model
     *
     * @return string|Response
     */
    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Campaign = new Race();
        $user = User::findIdentity(Yii::$app->user->id);
        $model = $Campaign->findOne($id);
        return $this->render('view', [
            'model' => $model,
            'user' => $user,
        ]);
    }

}
