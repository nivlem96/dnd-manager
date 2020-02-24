<?php


namespace app\controllers;

use app\models\LoginForm;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class UserController extends Controller {

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Register action.
     *
     * @return Response|string
     */
    public function actionRegister() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new User();
        if ($attributes = Yii::$app->request->post('User')) {
            $model->saveModel($attributes);
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Home action.
     *
     * @return Response|string
     */
    public function actionHome() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = Yii::$app->user->identity;
        return $this->render('home', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}