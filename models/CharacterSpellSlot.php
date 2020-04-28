<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "character_spell_slot".
 *
 * @property int $id
 * @property int|null $cantrips
 * @property int|null $cantrips_remaining
 * @property int|null $1st
 * @property int|null $1st_remaining
 * @property int|null $2nd
 * @property int|null $2nd_remaining
 * @property int|null $3rd
 * @property int|null $3rd_remaining
 * @property int|null $4th
 * @property int|null $4th_remaining
 * @property int|null $5th
 * @property int|null $5th_remaining
 * @property int|null $6th
 * @property int|null $6th_remaining
 * @property int|null $7th
 * @property int|null $7th_remaining
 * @property int|null $8th
 * @property int|null $8th_remaining
 * @property int|null $9th
 * @property int|null $9th_remaining
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class CharacterSpellSlot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'character_spell_slot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cantrips', 'cantrips_remaining', '1st', '1st_remaining', '2nd', '2nd_remaining', '3rd', '3rd_remaining', '4th', '4th_remaining', '5th', '5th_remaining', '6th', '6th_remaining', '7th', '7th_remaining', '8th', '8th_remaining', '9th', '9th_remaining'], 'integer'],
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
            'cantrips' => 'Cantrips',
            'cantrips_remaining' => 'Cantrips Remaining',
            '1st' => '1st',
            '1st_remaining' => '1st Remaining',
            '2nd' => '2nd',
            '2nd_remaining' => '2nd Remaining',
            '3rd' => '3rd',
            '3rd_remaining' => '3rd Remaining',
            '4th' => '4th',
            '4th_remaining' => '4th Remaining',
            '5th' => '5th',
            '5th_remaining' => '5th Remaining',
            '6th' => '6th',
            '6th_remaining' => '6th Remaining',
            '7th' => '7th',
            '7th_remaining' => '7th Remaining',
            '8th' => '8th',
            '8th_remaining' => '8th Remaining',
            '9th' => '9th',
            '9th_remaining' => '9th Remaining',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
