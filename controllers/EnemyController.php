<?php

namespace app\controllers;

use app\models\Enemy;
use app\models\User;
use Yii;
use yii\web\Response;

class EnemyController extends \yii\web\Controller {
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * @var User  $User
     * @var Enemy $model
     *
     * @return string|Response
     */
    public function actionCreate($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Enemy();
        if ($attributes = Yii::$app->request->post('Enemy')) {
            $attributes['campaign_id'] = $id;
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                return $this->goBack(['/campaign/view', 'id' => $id]);
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
     * @var Enemy    $model
     *
     * @return string|Response
     */
    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Campaign = new Enemy();
        $model = $Campaign->findOne($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

}
