<?php

namespace app\controllers;

use app\models\Npc;
use app\models\User;
use Yii;
use yii\web\Response;

class NpcController extends \yii\web\Controller {
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * @var User $User
     * @var Npc  $model
     *
     * @return string|Response
     */
    public function actionCreate($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Npc();
        if ($attributes = Yii::$app->request->post('Npc')) {
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
     * @var Npc      $model
     *
     * @return string|Response
     */
    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Campaign = new Npc();
        $model = $Campaign->findOne($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

}
