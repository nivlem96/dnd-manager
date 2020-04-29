<?php

namespace app\controllers;

use app\models\Race;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Response;

class RaceController extends \yii\web\Controller {
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = User::findIdentity(Yii::$app->user->id);
        $dataProvider = new ActiveDataProvider([
            'query' => User::getUserAvailableClass(Yii::$app->user->id,Race::className()),
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
     * @var Race $model
     *
     * @return string|Response
     */
    public function actionCreate($parent_id = null) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Race();
        $model->parent_id = $parent_id;
        if ($attributes = Yii::$app->request->post('Race')) {
            $attributes['created_by_user_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            if ($model->validate()) {
                if(empty($model->ability_score_strength)) {
                    $model->ability_score_strength = 0;
                }
                if(empty($model->ability_score_dexterity)) {
                    $model->ability_score_dexterity = 0;
                }
                if(empty($model->ability_score_constitution)) {
                    $model->ability_score_constitution = 0;
                }
                if(empty($model->ability_score_intelligence)) {
                    $model->ability_score_intelligence = 0;
                }
                if(empty($model->ability_score_wisdom)) {
                    $model->ability_score_wisdom = 0;
                }
                if(empty($model->ability_score_charisma)) {
                    $model->ability_score_charisma = 0;
                }
                $model->save();
                return $this->goBack(['/race']);
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
     * @var Race $model
     *
     * @return string|Response
     */
    public function actionEdit($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = Race::find()->where(['id'=>$id])->one();
        if ($attributes = Yii::$app->request->post('Race')) {
            $attributes['created_by_user_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                return $this->goBack(['/race/view','id'=>$id]);
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
     * @var Race     $model
     *
     * @return string|Response
     */
    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Race = new Race();
        $user = User::findIdentity(Yii::$app->user->id);
        $model = $Race->findOne($id);
        $featProvider = new ActiveDataProvider([
            'query' => User::getUserAvailableFeatsByRace(Yii::$app->user->id,$id),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $subRaceProvider = new ActiveDataProvider([
            'query' => User::getUserAvailableSubRaces(Yii::$app->user->id,$id),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('view', [
            'model' => $model,
            'user' => $user,
            'featProvider' => $featProvider,
            'subRaceProvider' => $subRaceProvider,
        ]);
    }

    public function actionDelete($id) {
        $Race = new Race();
        try {
            $Race->findOne($id)->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }
        return $this->goBack(['/race']);
    }

}
