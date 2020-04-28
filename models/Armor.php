<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "armor".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $type
 * @property string|null $cost
 * @property float|null $weight
 * @property int $armor_class
 * @property string|null $armor_class_modifier
 * @property int|null $armor_class_modifier_max
 * @property int|null $strength_requirement
 * @property int $stealth_disandvantage
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by_user_id
 * @property int|null $proficiency_id
 *
 * @property User $createdByUser
 * @property Proficiency $proficiency
 */
class Armor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'armor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'armor_class'], 'required'],
            [['weight'], 'number'],
            [['armor_class', 'armor_class_modifier_max', 'strength_requirement', 'stealth_disandvantage', 'created_by_user_id', 'proficiency_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description', 'type', 'cost', 'armor_class_modifier'], 'string', 'max' => 255],
            [['created_by_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by_user_id' => 'id']],
            [['proficiency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proficiency::className(), 'targetAttribute' => ['proficiency_id' => 'id']],
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
            'description' => 'Description',
            'type' => 'Type',
            'cost' => 'Cost',
            'weight' => 'Weight',
            'armor_class' => 'Armor Class',
            'armor_class_modifier' => 'Armor Class Modifier',
            'armor_class_modifier_max' => 'Armor Class Modifier Max',
            'strength_requirement' => 'Strength Requirement',
            'stealth_disandvantage' => 'Stealth Disandvantage',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by_user_id' => 'Created By User ID',
            'proficiency_id' => 'Proficiency ID',
        ];
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
     * Gets query for [[Proficiency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProficiency()
    {
        return $this->hasOne(Proficiency::className(), ['id' => 'proficiency_id']);
    }
}
