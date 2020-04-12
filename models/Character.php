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
 * @property int           $strength
 * @property int           $dexterity
 * @property int           $constitution
 * @property int           $intelligence
 * @property int           $wisdom
 * @property int           $charisma
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
            [['name', 'race_id', 'player_id', 'strength', 'dexterity', 'constitution', 'intelligence', 'wisdom', 'charisma'], 'required'],
            [['race_id', 'player_id', 'campaign_id', 'level', 'strength', 'dexterity', 'constitution', 'intelligence', 'wisdom', 'charisma'], 'integer'],
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

    public function getStatModifier($value) {
        return floor($value / 2) - 5;
    }

    public static function getLevelUpFeats($characterId) {
        $character = Character::findone($characterId);
        $feats = [];
        foreach ($character->getClassRelation()->all() as $class) {
            $classFeats = Feat::find()->where(['class_id' => $class->class_id])->andWhere(['unlocked_at' => $class->level])->all();
            foreach ($classFeats as $feat) {
                $feats[] = $feat;
            }
        }
        $raceFeats = Feat::find()->where(['race_id' => $character->race_id])->andWhere(['unlocked_at' => $character->level])->all();
        foreach ($raceFeats as $feat) {
            $feats[] = $feat;
        }
        return $feats;
    }
}
