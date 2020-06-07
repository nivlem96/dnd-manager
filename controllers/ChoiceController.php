<?php

namespace app\controllers;

use app\models\Armor;
use app\models\Choice;
use app\models\ChoiceOption;
use app\models\Item;
use app\models\User;
use app\models\Weapon;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Response;

/**
 * Class ChoiceController
 * @package app\controllers
 */
class ChoiceController extends \yii\web\Controller {
    /**
     * @return string|Response
     */
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = User::findIdentity(Yii::$app->user->id);
        $dataProvider = new ActiveDataProvider([
            'query' => User::getUserAvailableClass(Yii::$app->user->id, Choice::className()),
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
     *
     * @param int $step
     *
     * @return string|Response
     */
    public function actionCreate() {
        $user = Yii::$app->user;
        if ($user->isGuest) {
            return $this->goHome();
        }
        $model = new Choice();
        if ($attributes = Yii::$app->request->post('Choice')) {
            $attributes['created_by_user_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            $model->relation_class = $_GET['relation_class'];
            $model->relation_id = $_GET['relation_id'];
            if ($model->validate()) {
                $model->save();
                $id = Yii::$app->db->getLastInsertID();
                $class = '';
                switch ($model->choice_type) {
                    case 'item':
                        $class = Item::className();
                        break;
                    case 'armor':
                        $class = Armor::className();
                        break;
                    case 'weapon':
                        $class = Weapon::className();
                        break;
//                            case 'tool':
//                                $options = User::getUserAvailableClassArray($user->id,Tool::className());
//                                break;
                }
                $options = User::getUserAvailableClassArray($user->id, $class, false);
                $optionModel = new ChoiceOption();
                $optionModel->choice_id = $id;
                $optionModel->equipment_type = $model->choice_type;
                return $this->render('create-2', [
                    'model' => $optionModel,
                    'options' => $options,
                ]);
            } else {
                var_dump($model->getErrors());
            }
        }
        if ($attributes = Yii::$app->request->post('ChoiceOption')) {
            $options = $attributes['options'];
            foreach ($options as $option) {
                $optionModel = new ChoiceOption();
                $optionModel->choice_id = $attributes['choice_id'];
                $optionModel->equipment_id = $option;
                $optionModel->equipment_type = $attributes['equipment_type'];
                if ($optionModel->validate()) {
                    $optionModel->save();
                } else {
                    var_dump($optionModel->getErrors());
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @var User   $User
     * @var Choice $model
     *
     * @return string|Response
     */
    public function actionEdit($id) {
        $user = Yii::$app->user;
        if ($user->isGuest) {
            return $this->goHome();
        }
        $model = Choice::find()->where(['id' => $id])->one();
        if ($attributes = Yii::$app->request->post('Choice')) {
            $attributes['created_by_user_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            $model->relation_class = $_GET['relation_class'];
            $model->relation_id = $_GET['relation_id'];
            if ($model->validate()) {
                $model->save();
                $id = Yii::$app->db->getLastInsertID();
                $class = '';
                switch ($model->choice_type) {
                    case 'item':
                        $class = Item::className();
                        break;
                    case 'armor':
                        $class = Armor::className();
                        break;
                    case 'weapon':
                        $class = Weapon::className();
                        break;
//                            case 'tool':
//                                $options = User::getUserAvailableClassArray($user->id,Tool::className());
//                                break;
                }
                $options = User::getUserAvailableClassArray($user->id, $class, false);
                $optionModel = new ChoiceOption();
                $optionModel->choice_id = $id;
                $optionModel->equipment_type = $model->choice_type;
                return $this->render('create-2', [
                    'model' => $optionModel,
                    'options' => $options,
                ]);
            } else {
                var_dump($model->getErrors());
            }
        }
        if ($attributes = Yii::$app->request->post('ChoiceOption')) {
            ChoiceOption::deleteAll(['choice_id'=>$attributes['choice_id']]);
            $options = $attributes['options'];
            foreach ($options as $option) {
                $optionModel = new ChoiceOption();
                $optionModel->choice_id = $attributes['choice_id'];
                $optionModel->equipment_id = $option;
                $optionModel->equipment_type = $attributes['equipment_type'];
                if ($optionModel->validate()) {
                    $optionModel->save();
                } else {
                    var_dump($optionModel->getErrors());
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param        $id
     *
     * @var Choice   $model
     *
     * @return string|Response
     */
    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Choice = new Choice();
        $user = User::findIdentity(Yii::$app->user->id);
        $model = $Choice->findOne($id);
        return $this->render('view', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * @param $id
     *
     * @return Response
     */
    public function actionDelete($id) {
        $Choice = new Choice();
        try {
            $Choice->findOne($id)->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }
        return $this->goBack(['/choice']);
    }

}
