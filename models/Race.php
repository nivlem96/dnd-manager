<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "race".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $created_by_user_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $parent_id
 *
 * @property Character[] $characters
 * @property Feat[] $feats
 * @property FeatRelation[] $featRelations
 * @property Npc[] $npcs
 * @property Race $parent
 * @property Race[] $races
 * @property User $createdByUser
 */
class Race extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'race';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['created_by_user_id', 'parent_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Race::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'description' => 'Description',
            'created_by_user_id' => 'Created By User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'parent_id' => 'Parent',
        ];
    }

    /**
     * Gets query for [[Characters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Character::className(), ['race_id' => 'id']);
    }

    /**
     * Gets query for [[Feats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeats()
    {
        return $this->hasMany(Feat::className(), ['race_id' => 'id']);
    }

    /**
     * Gets query for [[FeatRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeatRelations()
    {
        return $this->hasMany(FeatRelation::className(), ['race_id' => 'id']);
    }

    /**
     * Gets query for [[Npcs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNpcs()
    {
        return $this->hasMany(Npc::className(), ['race_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Race::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Races]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRaces()
    {
        return $this->hasMany(Race::className(), ['parent_id' => 'id']);
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
}
