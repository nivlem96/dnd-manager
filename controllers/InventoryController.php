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

    public function actionToggleEquipment() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id = $data['id'];
            $value = $data['equipped'];
            $inventory = Inventory::findOne($id);
            if ($value == 1) {
                $equippedInventory = Inventory::find()->where(['character_id' => $inventory->character_id])->andWhere(['equipped' => 1])->andWhere(['equipment_table' => $inventory->equipment_table])->all();
                if (count($equippedInventory) > 0) {
                    foreach ($equippedInventory as $inv) {
                        $inv->equipped = 0;
                        $inv->save();
                    }
                }
            }
            $inventory->equipped = $value;
            $inventory->save();
        }
    }

}
