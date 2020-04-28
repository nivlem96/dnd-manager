<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "skill".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property DefaultSkill[] $defaultSkills
 * @property SkillRelation[] $skillRelations
 */
class Skill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'skill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[DefaultSkills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultSkills()
    {
        return $this->hasMany(DefaultSkill::className(), ['skill_id' => 'id']);
    }

    /**
     * Gets query for [[SkillRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSkillRelations()
    {
        return $this->hasMany(SkillRelation::className(), ['skill_id' => 'id']);
    }
}
