<?php

namespace app\controllers;

use app\models\Background;
use app\models\DefaultLanguages;
use app\models\DefaultSkill;
use app\models\ProficiencyRelation;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Response;

class BackgroundController extends \yii\web\Controller {
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = User::findIdentity(Yii::$app->user->id);
        $dataProvider = new ActiveDataProvider([
            'query' => User::getUserAvailableClass(Yii::$app->user->id,Background::className()),
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
     * @var Background $model
     *
     * @return string|Response
     */
    public function actionCreate() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Background();
        if ($attributes = Yii::$app->request->post('Background')) {
            $attributes['created_by_user_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                $id = Yii::$app->db->getLastInsertID();
                DefaultSkill::deleteAll(['background_id'=>$id]);
                foreach ($attributes['skills_to_choose'] as $skillId) {
                    $SkillRelation = new DefaultSkill();
                    $SkillRelation->skill_id = $skillId;
                    $SkillRelation->background_id = $id;
                    $SkillRelation->save();
                }
                return $this->goBack(['/background']);
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
     * @var User $User
     * @var Background $model
     *
     * @return string|Response
     */
    public function actionEdit($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = User::findIdentity(Yii::$app->user->id);
        /** @var Background $model */
        $model = Background::find()->where(['id'=>$id])->one();
        $model->skills_to_choose = $model->getDefaultSkillArray();
        $model->proficiencies = $model->getProficiencies();
        if ($attributes = Yii::$app->request->post('Background')) {
            $attributes['created_by_user_id'] = Yii::$app->user->id;
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                DefaultSkill::deleteAll(['background_id'=>$id]);
                foreach ($attributes['skills_to_choose'] as $skillId) {
                    $SkillRelation = new DefaultSkill();
                    $SkillRelation->skill_id = $skillId;
                    $SkillRelation->background_id = $id;
                    $SkillRelation->save();
                }
                foreach ($attributes['proficiencies'] as $proficiencyId) {
                    $SkillRelation = new ProficiencyRelation();
                    $SkillRelation->proficiency_id = $proficiencyId;
                    $SkillRelation->background_id = $id;
                    $SkillRelation->save();
                }
                foreach ($attributes['choice_proficiencies'] as $proficiencyId) {
                    $SkillRelation = new ProficiencyRelation();
                    $SkillRelation->proficiency_id = $proficiencyId;
                    $SkillRelation->background_id = $id;
                    $SkillRelation->choice = 1;
                    $SkillRelation->save();
                }
                foreach ($attributes['default_languages'] as $languageId) {
                    $SkillRelation = new DefaultLanguages();
                    $SkillRelation->language_id = $languageId;
                    $SkillRelation->background_id = $id;
                    $SkillRelation->save();
                }
                return $this->goBack(['/background/view','id'=>$id]);
            } else {
                var_dump($model->getErrors());
            }
        }
        return $this->render('create', [
            'user' => $user,
            'model' => $model,
        ]);
    }

    /**
     * @param        $id
     *
     * @var Background     $model
     *
     * @return string|Response
     */
    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Background = new Background();
        $user = User::findIdentity(Yii::$app->user->id);
        $model = $Background->findOne($id);
        $choiceProvider = new ActiveDataProvider([
            'query' => $model->getChoices(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('view', [
            'model' => $model,
            'user' => $user,
            'choiceProvider' => $choiceProvider,
        ]);
    }

    public function actionDelete($id) {
        $Background = new Background();
        try {
            $Background->findOne($id)->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }
        return $this->goBack(['/background']);
    }

}
