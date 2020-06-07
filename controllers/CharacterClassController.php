<?php

namespace app\controllers;

use app\models\CharacterClass;
use app\models\DefaultSkill;
use app\models\SkillRelation;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Response;

class CharacterClassController extends \yii\web\Controller {
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = User::findIdentity(Yii::$app->user->id);
        $dataProvider = new ActiveDataProvider([
            'query' => User::getUserAvailableClass(Yii::$app->user->id, CharacterClass::className()),
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
     * @var User           $User
     * @var CharacterClass $model
     *
     * @return string|Response
     */
    public function actionEdit($id = null) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (isset($id)) {
            $model = CharacterClass::find()->where(['id' => $id])->one();
        } else {
            $model = new CharacterClass();
        }
        if ($attributes = Yii::$app->request->post('CharacterClass')) {
            $attributes['created_by_user_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                if (empty($id)) {
                    $id = Yii::$app->db->getLastInsertID();
                }
                DefaultSkill::deleteAll(['class_id'=>$id]);
                foreach ($attributes['skills_to_choose'] as $skillId) {
                    $SkillRelation = new DefaultSkill();
                    $SkillRelation->skill_id = $skillId;
                    $SkillRelation->class_id = $id;
                    $SkillRelation->save();
                }
                return $this->goBack(['/character-class/view', 'id' => $id]);
            } else {
                var_dump($model->getErrors());
            }
        }
        return $this->render('create', [
            'model' => $model,
            'user' => Yii::$app->user,
        ]);
    }

    /**
     * @param              $id
     *
     * @var CharacterClass $model
     *
     * @return string|Response
     */
    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $CharacterClass = new CharacterClass();
        $user = User::findIdentity(Yii::$app->user->id);
        $model = $CharacterClass->findOne($id);
        $featProvider = new ActiveDataProvider([
            'query' => $model->getFeats(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $choiceProvider = new ActiveDataProvider([
            'query' => $model->getChoices(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('view', [
            'model' => $model,
            'user' => $user,
            'featProvider' => $featProvider,
            'choiceProvider' => $choiceProvider,
        ]);
    }

    public function actionDelete($id) {
        $CharacterClass = new CharacterClass();
        try {
            $CharacterClass->findOne($id)->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }
        return $this->goBack(['/character-class']);
    }

}
