<?php

namespace app\controllers;

use app\models\Inventory;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Response;

class InventoryController extends \yii\web\Controller {

    public function actionDelete($id, $characterId) {
        $Inventory = new Inventory();
        try {
            $Inventory->findOne($id)->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }
        return $this->goBack(['/character/view', 'id' => $characterId]);
    }

    /**
     * @var User      $User
     * @var Inventory $model
     *
     * @return string|Response
     */
    public function actionAdd($characterId) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Inventory();
        if ($attributes = Yii::$app->request->post('Inventory')) {
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

}
