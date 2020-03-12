<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "character_class".
 *
 * @property int $id
 * @property string $name
 *
 * @property Character[] $characters
 * @property Npc[] $npcs
 */
class CharacterClass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'character_class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Gets query for [[Characters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Character::className(), ['class_id' => 'id']);
    }

    /**
     * Gets query for [[Npcs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNpcs()
    {
        return $this->hasMany(Npc::className(), ['class_id' => 'id']);
    }
}