<?php

namespace app\controllers;

use app\models\Feat;
use app\models\FeatLevel;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Response;

class FeatLevelController extends \yii\web\Controller {

    /**
     * @var User $User
     * @var Feat $model
     *
     * @return string|Response
     */
    public function actionCreate($feat_id, int $id = null) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (!empty($id)) {
            $model = FeatLevel::findOne(['id' => $id]);
        } else {
            $model = new FeatLevel();
        }
        $model->feat_id = $feat_id;
        if ($attributes = Yii::$app->request->post('FeatLevel')) {
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                return $this->goBack(['/feat/view', 'id' => $feat_id]);
            } else {
                var_dump($model->getErrors());
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        $Feat = new FeatLevel();
        try {
            $featLevel = $Feat->findOne($id);
            $feat_id = $featLevel->feat_id;
            $featLevel->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }
        return $this->goBack(['/feat/view', 'id' => $feat_id]);
    }

}
