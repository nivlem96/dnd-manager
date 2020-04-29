<?php

namespace app\controllers;

use app\models\Weapon;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Response;

class WeaponController extends \yii\web\Controller {
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = User::findIdentity(Yii::$app->user->id);
        $dataProvider = new ActiveDataProvider([
            'query' => User::getUserAvailableClass(Yii::$app->user->id,Weapon::className()),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'user' => $user,
        ]);
    }

    /**
     * @var User $User
     * @var Weapon $model
     *
     * @return string|Response
     */
    public function actionCreate() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Weapon();
        if ($attributes = Yii::$app->request->post('Weapon')) {
            $attributes['created_by_user_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                return $this->goBack(['/weapon']);
            } else {
                var_dump($model->getErrors());
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @var User $User
     * @var Weapon $model
     *
     * @return string|Response
     */
    public function actionEdit($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = Weapon::find()->where(['id'=>$id])->one();
        if ($attributes = Yii::$app->request->post('Weapon')) {
            $attributes['created_by_user_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                return $this->goBack(['/weapon/view','id'=>$id]);
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
     * @var Weapon     $model
     *
     * @return string|Response
     */
    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Weapon = new Weapon();
        $user = User::findIdentity(Yii::$app->user->id);
        $model = $Weapon->findOne($id);
        return $this->render('view', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    public function actionDelete($id) {
        $Weapon = new Weapon();
        try {
            $Weapon->findOne($id)->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }
        return $this->goBack(['/weapon']);
    }

}
