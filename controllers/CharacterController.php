<?php

namespace app\controllers;
use app\models\Character;
use app\models\User;
use Yii;
use yii\web\Response;

class CharacterController extends \yii\web\Controller {
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * @var User     $User
     * @var Character $model
     *
     * @return string|Response
     */
    public function actionCreate($campaign_id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Character();
        if ($attributes = Yii::$app->request->post('Character')) {
            $attributes['campaign_id'] = $campaign_id;
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                return $this->actionIndex();
            } else {
                var_dump($model->getErrors());
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

}
