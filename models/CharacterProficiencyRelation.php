<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "character_proficiency_relation".
 *
 * @property int $id
 * @property int|null $character_id
 * @property int|null $proficiency_id
 *
 * @property Character $character
 * @property Proficiency $proficiency
 */
class CharacterProficiencyRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'character_proficiency_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['character_id', 'proficiency_id'], 'integer'],
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Character::className(), 'targetAttribute' => ['character_id' => 'id']],
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
            'character_id' => 'Character ID',
            'proficiency_id' => 'Proficiency ID',
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
     * Gets query for [[Proficiency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProficiency()
    {
        return $this->hasOne(Proficiency::className(), ['id' => 'proficiency_id']);
    }
}
