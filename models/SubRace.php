<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_race".
 *
 * @property int $id
 * @property int $race_id
 * @property string $name
 * @property string|null $description
 * @property int|null $created_by_user_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Character[] $characters
 * @property Feat[] $feats
 * @property Race $race
 */
class SubRace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_race';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['race_id', 'name'], 'required'],
            [['race_id', 'created_by_user_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['race_id'], 'exist', 'skipOnError' => true, 'targetClass' => Race::className(), 'targetAttribute' => ['race_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'race_id' => 'Race ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_by_user_id' => 'Created By User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Characters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Character::className(), ['sub_race_id' => 'id']);
    }

    /**
     * Gets query for [[Feats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeats()
    {
        return $this->hasMany(Feat::className(), ['sub_race_id' => 'id']);
    }

    /**
     * Gets query for [[Race]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }
}
