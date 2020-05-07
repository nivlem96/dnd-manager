<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "skill_relation".
 *
 * @property int $id
 * @property int|null $skill_id
 * @property int|null $character_id
 * @property int|null $proficient
 *
 * @property Character $character
 * @property Skill $skill
 */
class SkillRelation extends \yii\db\ActiveRecord
{
    public $modifier;

    public function init() {
        if(!empty($this->id)) {
            $this->modifier = $this->getModifier();
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'skill_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['skill_id', 'character_id', 'proficient'], 'integer'],
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Character::className(), 'targetAttribute' => ['character_id' => 'id']],
            [['skill_id'], 'exist', 'skipOnError' => true, 'targetClass' => Skill::className(), 'targetAttribute' => ['skill_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'skill_id' => 'Skill ID',
            'character_id' => 'Character ID',
            'proficient' => 'Proficient',
        ];
    }

    /**
     * Gets query for [[Character]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacter()
    {
        return $this->hasOne(Character::className(), ['id' => 'character_id']);
    }

    /**
     * Gets query for [[Skill]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(Skill::className(), ['id' => 'skill_id']);
    }

    /**
     * Gets query for [[Skill]].
     *
     * @return int
     */
    public function getModifier()
    {
        $proficient = (bool)$this->proficient;
        $modifier = $this->character->getStatModifier($this->skill->stat);
        if($proficient) {
            $modifier += $this->character->proficiency;
        }
        return $modifier;
    }
}
