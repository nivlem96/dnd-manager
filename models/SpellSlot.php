<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spell_slot".
 *
 * @property int $id
 * @property int|null $class_id
 * @property int|null $level
 * @property int|null $cantrips
 * @property int|null $1st
 * @property int|null $2nd
 * @property int|null $3rd
 * @property int|null $4th
 * @property int|null $5th
 * @property int|null $6th
 * @property int|null $7th
 * @property int|null $8th
 * @property int|null $9th
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property CharacterClass $class
 */
class SpellSlot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spell_slot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'level', 'cantrips', '1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => CharacterClass::className(), 'targetAttribute' => ['class_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_id' => 'Class ID',
            'level' => 'Level',
            'cantrips' => 'Cantrips',
            '1st' => '1st',
            '2nd' => '2nd',
            '3rd' => '3rd',
            '4th' => '4th',
            '5th' => '5th',
            '6th' => '6th',
            '7th' => '7th',
            '8th' => '8th',
            '9th' => '9th',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Class]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(CharacterClass::className(), ['id' => 'class_id']);
    }
}
