<?php

namespace app\controllers;

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

}
