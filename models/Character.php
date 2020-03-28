<?php

namespace app\models;

use Yii;
use yii\base\InvalidConfigException;

/**
 * This is the model class for table "character".
 *
 * @property int           $id
 * @property string        $name
 * @property int           $race_id
 * @property string|null   $background
 * @property int           $player_id
 * @property int|null      $campaign_id
 * @property int           $level
 *
 * @property Campaign      $campaign
 * @property User          $player
 * @property ClassRelation $classRelation
 * @property FeatRelation  $featRelation
 */
class Character extends \yii\db\ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'character';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'race_id', 'player_id'], 'required'],
            [['race_id', 'player_id', 'campaign_id', 'level'], 'integer'],
            [['background'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['campaign_id'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::className(), 'targetAttribute' => ['campaign_id' => 'id']],
            [['player_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['player_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'level' => 'Level',
            'race_id' => 'Race ID',
            'background' => 'Background',
            'player_id' => 'Player ID',
            'campaign_id' => 'Campaign ID',
        ];
    }

    /**
     * Gets query for [[Campaign]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCampaign() {
        return $this->hasOne(Campaign::className(), ['id' => 'campaign_id']);
    }

    /**
     * Gets query for [[Race]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRace() {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }

    /**
     * Gets query for [[SubRace]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubRace() {
        return $this->hasOne(SubRace::className(), ['id' => 'sub_race_id']);
    }

    /**
     * Gets query for [[Player]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer() {
        return $this->hasOne(User::className(), ['id' => 'player_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassRelation() {
        return $this->hasMany(ClassRelation::className(), ['character_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeatRelation() {
        return $this->hasMany(FeatRelation::className(), ['character_id' => 'id']);
    }
}
