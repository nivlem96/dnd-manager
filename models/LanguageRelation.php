<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "language_relation".
 *
 * @property int $id
 * @property int $language_id
 * @property int $character_id
 *
 * @property Character $character
 * @property Language $language
 */
class LanguageRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language_id', 'character_id'], 'required'],
            [['language_id', 'character_id'], 'integer'],
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Character::className(), 'targetAttribute' => ['character_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language_id' => 'Language ID',
            'character_id' => 'Character ID',
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
     * Gets query for [[Language]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }
}
