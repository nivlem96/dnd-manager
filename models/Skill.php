<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "skill".
 *
 * @property int $id
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by_user_id
 * @property string $stat
 *
 * @property DefaultSkill[] $defaultSkills
 * @property User $createdByUser
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
            [['name', 'stat'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by_user_id'], 'integer'],
            [['name', 'stat'], 'string', 'max' => 255],
            [['created_by_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by_user_id' => 'id']],
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
            'created_by_user_id' => 'Created By User ID',
            'stat' => 'Stat',
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
     * Gets query for [[CreatedByUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedByUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by_user_id']);
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