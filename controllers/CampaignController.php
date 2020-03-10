<?php

namespace app\controllers;

use app\models\Event;
use app\models\User;
use app\models\Campaign;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class CampaignController
 * @package app\controllers
 */
class CampaignController extends Controller {
    /**
     * @var User $User
     * @var Campaign $model
     *
     * @return string|Response
     */
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $User = new User();
        $model = $User->findOne(Yii::$app->user->id)->campaigns;
        return $this->render('index', [
            'model' => $model,
        ]);
    }
    /**
     * @var User $User
     * @var Campaign $model
     *
     * @return string|Response
     */
    public function actionCreate() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Campaign();
        if ($attributes = Yii::$app->request->post('User')) {
            $attributes['dm_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            $model->save();
            return $this->goBack();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param        $id
     *
     * @var Campaign $model
     *
     * @return string|Response
     */
    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Campaign = new Campaign();
        $model = $Campaign->findOne($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @param        $id
     *
     * @var Event $model
     *
     * @return string|Response
     */
    public function actionEvent($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Event = new Event();
        $model = $Event->findOne($id);
        return $this->render('event', [
            'model' => $model,
        ]);
    }

}
