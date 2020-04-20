<?php

namespace app\controllers;

use app\models\Inventory;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Response;

class InventoryController extends \yii\web\Controller {
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = User::findIdentity(Yii::$app->user->id);
        $dataProvider = new ActiveDataProvider([
            'query' => User::getUserAvailableInventorys(Yii::$app->user->id),
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
     * @var Inventory $model
     *
     * @return string|Response
     */
    public function actionCreate() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Inventory();
        if ($attributes = Yii::$app->request->post('Inventory')) {
            $attributes['created_by_user_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                return $this->goBack(['/inventory']);
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
     * @var Inventory $model
     *
     * @return string|Response
     */
    public function actionEdit($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = Inventory::find()->where(['id'=>$id])->one();
        if ($attributes = Yii::$app->request->post('Inventory')) {
            $attributes['created_by_user_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                return $this->goBack(['/inventory/view','id'=>$id]);
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
     * @var Inventory     $model
     *
     * @return string|Response
     */
    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Inventory = new Inventory();
        $user = User::findIdentity(Yii::$app->user->id);
        $model = $Inventory->findOne($id);
        return $this->render('view', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    public function actionDelete($id) {
        $Inventory = new Inventory();
        try {
            $Inventory->findOne($id)->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }
        return $this->goBack(['/inventory']);
    }

}
