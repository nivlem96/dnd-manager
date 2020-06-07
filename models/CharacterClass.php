<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "character_class".
 *
 * @property int                   $id
 * @property string                $name
 * @property int|null              $created_by_user_id
 * @property string|null           $created_at
 * @property string|null           $updated_at
 * @property int                   $hitdice
 * @property string|null           $saving_throws
 * @property int|null              $skill_choices
 * @property string|null           $spell_stat
 * @property int|null              $parent_id
 *
 * @property CharacterClass        $parent
 * @property CharacterClass[]      $characterClasses
 * @property User                  $createdByUser
 * @property Choice[]              $choices
 * @property ClassRelation[]       $classRelations
 * @property DefaultSkill[]        $defaultSkills
 * @property Feat[]                $feats
 * @property FeatRelation[]        $featRelations
 * @property Npc[]                 $npcs
 * @property ProficiencyRelation[] $proficiencyRelations
 * @property SpellSlot[]           $spellSlots
 */
class CharacterClass extends \yii\db\ActiveRecord {
    public $skills_to_choose;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'character_class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['created_by_user_id', 'hitdice', 'skill_choices', 'parent_id'], 'integer'],
            [['created_at', 'updated_at', 'saving_throws'], 'safe'],
            [['name', 'spell_stat'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => CharacterClass::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['created_by_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_by_user_id' => 'Created By User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'hitdice' => 'Hitdice',
            'saving_throws' => 'Saving Throws',
            'skill_choices' => 'Skill Choices',
            'spell_stat' => 'Spell Stat',
            'parent_id' => 'Parent ID',
        ];
    }

    public function afterFind() {
        if (is_string($this->saving_throws)) {
            $this->saving_throws = json_decode($this->saving_throws, true);
        }
        if (!empty($defaultSkills = $this->getDefaultSkills()->all())) {
            $result = [];
            foreach ($defaultSkills as $skill) {
                $result[] = $skill->skill_id;
            }
            $this->skills_to_choose = $result;
        }
    }


    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent() {
        return $this->hasOne(CharacterClass::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[CharacterClasses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterClasses() {
        return $this->hasMany(CharacterClass::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedByUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedByUser() {
        return $this->hasOne(User::className(), ['id' => 'created_by_user_id']);
    }

    /**
     * Gets query for [[Choices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChoices() {
        return Choice::find()->where(['relation_class' => CharacterClass::className()])->andWhere(['relation_id' => $this->id]);
    }

    /**
     * Gets query for [[ClassRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClassRelations() {
        return $this->hasMany(ClassRelation::className(), ['class_id' => 'id']);
    }

    /**
     * Gets query for [[DefaultSkills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultSkills() {
        return $this->hasMany(DefaultSkill::className(), ['class_id' => 'id']);
    }

    /**
     * Gets query for [[Feats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeats() {
        return $this->hasMany(Feat::className(), ['class_id' => 'id']);
    }

    /**
     * Gets query for [[FeatRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeatRelations() {
        return $this->hasMany(FeatRelation::className(), ['class_id' => 'id']);
    }

    /**
     * Gets query for [[Npcs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNpcs() {
        return $this->hasMany(Npc::className(), ['class_id' => 'id']);
    }

    /**
     * Gets query for [[ProficiencyRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProficiencyRelations() {
        return $this->hasMany(ProficiencyRelation::className(), ['class_id' => 'id']);
    }

    /**
     * Gets query for [[SpellSlots]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpellSlots() {
        return $this->hasMany(SpellSlot::className(), ['class_id' => 'id']);
    }
}
