<?php

namespace app\controllers;

use app\models\Character;
use app\models\CharacterClass;
use app\models\Choice;
use app\models\ClassRelation;
use app\models\FeatRelation;
use app\models\Inventory;
use app\models\Race;
use app\models\Skill;
use app\models\SkillRelation;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class CharacterController extends \yii\web\Controller {
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $User = new User();
        $dataProvider = new ActiveDataProvider([
            'query' => $User->findOne(Yii::$app->user->id)->getCharacters(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @var User      $User
     * @var Character $model
     *
     * @return string|Response
     */
    public function actionCreate($campaign_id = null) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Character();
        if ($attributes = Yii::$app->request->post('Character')) {
            if ($classAttributes = Yii::$app->request->post('ClassRelation')) {
                $attributes['campaign_id'] = $campaign_id;
                $model->setAttributes($attributes);
                $class = CharacterClass::findOne($classAttributes['class_id']);
                $race = Race::findOne($attributes['race_id']);
                $model->max_hitpoints = $class->hitdice + $model->getStatModifier('constitution');
                $model->current_hitpoints = $model->max_hitpoints;
                $model->speed = empty($race->speed) ? $race->parent->speed : $race->speed;
                $model->strength += $race->getAbilityScoreModifier('strength');
                $model->dexterity += $race->getAbilityScoreModifier('dexterity');
                $model->constitution += $race->getAbilityScoreModifier('constitution');
                $model->intelligence += $race->getAbilityScoreModifier('intelligence');
                $model->wisdom += $race->getAbilityScoreModifier('wisdom');
                $model->charisma += $race->getAbilityScoreModifier('charisma');
                if ($model->validate()) {
                    $model->save();
                    $id = Yii::$app->db->getLastInsertID();
                    $classData = [
                        'character_id' => $id,
                        'class_id' => $classAttributes['class_id'],
                    ];
                    $this->saveClassRelation($classData);
                    $this->saveFeatRelation($id);
                    $this->saveSkillRelation($id);
                    $choices = $model->getEquipmentOptions();
                    $skills = $model->getSkillChoices();
                    return $this->render('create-2', [
                        'model' => $model,
                        'choices' => $choices,
                        'skills' => $skills,
                        'id' => $id
                    ]);
                } else {
                    var_dump($model->getErrors());
                }
            }
        }
        if ($choices = Yii::$app->request->post('Inventory')) {
            $id = Yii::$app->request->post('characterId');
            $character = Character::findOne($id);
            $skillChoices = Yii::$app->request->post('Skills');
            foreach ($skillChoices as $skill) {
                /**
                 * @var SkillRelation $skillRelation
                 */
                $skillRelation = $character->getSkillRelation()->where(['skill_id'=>$skill])->one();
                $skillRelation->proficient = 1;
                $skillRelation->save();
            }
            foreach ($choices as $choice_id => $equipment_id) {
                $choice = Choice::findOne($choice_id);
                $inventory = New Inventory();
                $inventory->character_id = $id;
                $inventory->equipment_id = $equipment_id;
                $inventory->equipment_table = $choice->choice_type;
                if ($inventory->validate()) {
                    $inventory->save();
                } else {
                    var_dump($inventory->getErrors());
                }
            }
            return $this->goBack(['/character/view', 'id' => $id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @var User      $User
     * @var Character $model
     *
     * @return string|Response
     */
    public function actionEdit($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = Character::find()->where(['id' => $id])->one();
        if ($attributes = Yii::$app->request->post('Character')) {
            $model->setAttributes($attributes);
            if ($model->validate()) {
                $model->save();
                return $this->goBack(['/character/view', 'id' => $id]);
            } else {
                var_dump($model->getErrors());
            }
        }
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * @param         $id
     *
     * @var Character $model
     *
     * @return string|Response
     */
    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Character = new Character();
        $user = User::findIdentity(Yii::$app->user->id);
        $model = $Character->findOne($id);
        return $this->render('view', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * @param         $id
     *
     * @var Character $model
     *
     * @return string|Response
     */
    public function actionLevelUp($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if ($attributes = Yii::$app->request->post('ClassRelation')) {
            $classData = [
                'character_id' => $id,
                'class_id' => $attributes['class_id'],
            ];
            $this->saveClassRelation($classData);
            $this->goBack(['character/level-up-confirmation', 'characterId' => $id, 'classId' => $attributes['class_id']]);
        }
        $Character = new Character();
        $user = User::findIdentity(Yii::$app->user->id);
        $model = $Character->findOne($id);
        return $this->render('level-up', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * @param $classId
     * @param $characterId
     *
     * @return string|Response
     */
    public function actionLevelUpClass($classId, $characterId) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Character = new Character();
        $model = $Character->findOne($characterId);
        $model->level = $model->level + 1;
        $model->save();
        $classRelation = $model->getClassRelations();
        if ($relation = $classRelation->where(['=', 'class_id', $classId])->one()) {
            $relation->level = $relation->level + 1;
            $relation->save();
        }
        $this->goBack(['character/level-up-confirmation', 'characterId' => $characterId, 'classId' => $classId]);

    }

    /**
     * @param $classId
     * @param $characterId
     *
     * @return string|Response
     */
    public function actionLevelUpConfirmation($characterId, $classId) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $Character = Character::findOne($characterId);
        if ($attributes = Yii::$app->request->post('Character')) {
            $addNumber = $attributes['dice'] + $Character->getStatModifier('constitution') > 1 ? $attributes['dice'] + $Character->getStatModifier($Character->constitution) : 1;
            $Character->max_hitpoints += $addNumber;
            $Character->current_hitpoints += $addNumber;
            $Character->save();
            $this->goBack(['/character/view', 'id' => $characterId]);
        } else {
            $classRelation = $Character->getClassRelations()->where(['class_id'=>$classId])->one();
            $class = $classRelation->class;
            $model = $Character->findOne($characterId);
            $user = User::findIdentity(Yii::$app->user->id);
            $availableFeats = $this->saveFeatRelation($characterId);
            return $this->render('level-up-confirmation', [
                'model' => $model,
                'class' => $class,
                'user' => $user,
                'availableFeats' => $availableFeats,
            ]);
        }
    }

    public function actionDelete($id) {
        $Character = Character::findOne($id);
        try {
            Character::deleteRelations($id);
            $Character->delete();
        } catch (\Throwable $e) {
            var_dump($e);
        }
        return $this->goBack(['/character']);
    }

    private function saveClassRelation(array $data) {
        $relationModel = null;
        if (!empty($data['id'])) {
            $relationModel = ClassRelation::findOne($data['id']);
        }
        if ($relationModel == null) {
            $relationModel = new ClassRelation();
        }
        foreach ($data as $key => $value) {
            $relationModel->$key = $value;
        }
        if ($relationModel->validate()) {
            $relationModel->save();
        }
        return;
    }

    private function saveFeatRelation($characterId) {
        $availableFeats = Character::getLevelUpFeats($characterId);
        foreach ($availableFeats as $key => $feat) {
            $attributes = FeatRelation::find()->where(['character_id' => $characterId])->andWhere(['feat_id' => $feat->id])->all();
            if (empty($attributes)) {
                $featRelation = new FeatRelation();
                $featRelation->feat_id = $feat->id;
                $featRelation->character_id = $characterId;
                $featRelation->class_id = $feat->class_id;
                $featRelation->race_id = $feat->race_id;
                $featRelation->save();
            } else {
                unset($availableFeats[$key]);
            }
        }
        return $availableFeats;
    }

    private function saveSkillRelation($characterId) {
        $character = Character::findOne($characterId);
        $background = $character->getBackground()->one();
        $backgroundSkills = $background->getDefaultSkills()->select('skill_id')->column();
        $availableSkills = User::getUserAvailableClass(Yii::$app->user->id,Skill::className())->all();
        foreach ($availableSkills as $key => $skill) {
            $attributes = SkillRelation::find()->where(['character_id' => $characterId])->andWhere(['skill_id' => $skill->id])->all();
            if (empty($attributes)) {
                $skillRelation = new SkillRelation();
                $skillRelation->skill_id = $skill->id;
                $skillRelation->character_id = $characterId;
                $skillRelation->proficient = in_array($skill->id,$backgroundSkills) ? 1 : 0;
                $skillRelation->save();
            } else {
                unset($availableSkills[$key]);
            }
        }
        return $availableSkills;
    }

}
