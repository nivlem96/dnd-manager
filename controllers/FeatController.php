<?php

namespace app\controllers;

use app\models\Feat;
use app\models\FeatLevel;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Response;

class FeatController extends \yii\web\Controller {
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = User::findIdentity(Yii::$app->user->id);
        $dataProvider = new ActiveDataProvider([
            'query' => User::getUserAvailableClass(Yii::$app->user->id, Feat::className()),
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
     * @var Feat $model
     *
     * @return string|Response
     */
    public function actionCreate($race_id = null, $class_id = null) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Feat();
        $model->race_id = $race_id;
        $model->class_id = $class_id;
        if ($attributes = Yii::$app->request->post('Feat')) {
            $model->setAttributes($attributes);
            $model->created_by_user_id = Yii::$app->user->id;
            $model->race_id = $attributes['race_id'] == 0 ? null : $attributes['race_id'];
            $model->class_id = $attributes['class_id'] == 0 ? null : $attributes['class_id'];
            if ($model->validate()) {
                $model->save();
                return $this->goBack(['/feat']);
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
     *
     * @return string|Response
     */
    public function actionEdit($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        /**
         * @var Feat $model
         */
        $model = Feat::find()->where(['id' => $id])->one();
        if ($attributes = Yii::$app->request->post('Feat')) {
            $attributes['created_by_user_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            $model->created_by_user_id = Yii::$app->user->id;
            $model->race_id = $attributes['race_id'] == 0 ? null : $attributes['race_id'];
            $model->class_id = $attributes['class_id'] == 0 ? null : $attributes['class_id'];
            if ($model->validate()) {
                $model->save();
                return $this->goBack(['/feat/view', 'id' => $id]);
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
     * @var Feat     $model
     *
     * @return string|Response
     */
    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Feat = new Feat();
        $user = User::findIdentity(Yii::$app->user->id);
        $model = $Feat->findOne($id);
        $featLevelProvider = new ActiveDataProvider([
            'query' => $model->getFeatLevels(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('view', [
            'model' => $model,
            'user' => $user,
            'featLevelProvider' => $featLevelProvider,
        ]);
    }

    public function actionDelete($id) {
        $Feat = new Feat();
        try {
            $Feat->findOne($id)->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }
        return $this->goBack(['/feat']);
    }

}
