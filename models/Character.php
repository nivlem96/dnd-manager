<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "character".
 *
 * @property int                            $id
 * @property string                         $name
 * @property string|null                    $background
 * @property int|null                       $race_id
 * @property int|null                       $player_id
 * @property int|null                       $campaign_id
 * @property string|null                    $created_at
 * @property string|null                    $updated_at
 * @property int|null                       $level
 * @property int                            $strength
 * @property int                            $dexterity
 * @property int                            $constitution
 * @property int                            $intelligence
 * @property int                            $wisdom
 * @property int                            $charisma
 * @property int                            $max_hitpoints
 * @property int                            $current_hitpoints
 * @property int                            $proficiency
 * @property int                            $speed
 *
 * @property Campaign                       $campaign
 * @property Race                           $race
 * @property User                           $player
 * @property CharacterProficiencyRelation[] $characterProficiencyRelations
 * @property ClassRelation[]                $classRelations
 * @property FeatRelation[]                 $featRelations
 * @property Inventory[]                    $inventories
 * @property LanguageRelation[]             $languageRelations
 * @property SkillRelation[]                $skillRelations
 *
 * @property int                            $armor_class
 */
class Character extends \yii\db\ActiveRecord {
    public $armor_class;

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
            [['name'], 'required'],
            [['background'], 'string'],
            [['race_id', 'player_id', 'campaign_id', 'level', 'strength', 'dexterity', 'constitution', 'intelligence', 'wisdom', 'charisma', 'max_hitpoints', 'current_hitpoints', 'proficiency', 'speed'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['campaign_id'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::className(), 'targetAttribute' => ['campaign_id' => 'id']],
            [['race_id'], 'exist', 'skipOnError' => true, 'targetClass' => Race::className(), 'targetAttribute' => ['race_id' => 'id']],
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
            'background' => 'Background',
            'race_id' => 'Race ID',
            'player_id' => 'Player ID',
            'campaign_id' => 'Campaign ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'level' => 'Level',
            'strength' => 'Strength',
            'dexterity' => 'Dexterity',
            'constitution' => 'Constitution',
            'intelligence' => 'Intelligence',
            'wisdom' => 'Wisdom',
            'charisma' => 'Charisma',
            'max_hitpoints' => 'Max Hitpoints',
            'current_hitpoints' => 'Current Hitpoints',
            'proficiency' => 'Proficiency',
            'speed' => 'Speed',
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
     * Gets query for [[CharacterProficiencyRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterProficiencyRelations() {
        return $this->hasMany(CharacterProficiencyRelation::className(), ['character_id' => 'id']);
    }

    /**
     * Gets query for [[ClassRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClassRelations() {
        return $this->hasMany(ClassRelation::className(), ['character_id' => 'id']);
    }

    /**
     * Gets query for [[FeatRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeatRelations() {
        return $this->hasMany(FeatRelation::className(), ['character_id' => 'id']);
    }

    /**
     * Gets query for [[Inventories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInventories() {
        return $this->hasMany(Inventory::className(), ['character_id' => 'id']);
    }

    /**
     * Gets query for [[LanguageRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguageRelations() {
        return $this->hasMany(LanguageRelation::className(), ['character_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeatRelation() {
        return $this->hasMany(FeatRelation::className(), ['character_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkillRelation() {
        return $this->hasMany(SkillRelation::className(), ['character_id' => 'id']);
    }

    public function getStatValue($stat) {
        $stat = strtolower($stat);
        return $this->$stat;
    }

    /**
     * @param $stat
     *
     * @return int
     */
    public function getStatModifier($stat) {
        $stat = strtolower($stat);
        $value = $this->getStatValue($stat);
        return floor($value / 2) - 5;
    }

    public static function getLevelUpFeats($characterId) {
        $character = Character::findone($characterId);
        $feats = [];
        foreach ($character->getClassRelations()->all() as $class) {
            $classFeats = Feat::find()->where(['class_id' => $class->class_id])->andWhere(['unlocked_at' => $class->level])->all();
            foreach ($classFeats as $feat) {
                $feats[] = $feat;
            }
        }
        $raceFeats = Feat::find()->where(['race_id' => $character->race_id])->orWhere(['race_id' => $character->race->parent_id])->andWhere(['unlocked_at' => $character->level])->all();
        foreach ($raceFeats as $feat) {
            $feats[] = $feat;
        }
        return $feats;
    }

    public static function deleteRelations($characterId) {
        CharacterProficiencyRelation::deleteAll(['character_id' => $characterId]);
        ClassRelation::deleteAll(['character_id' => $characterId]);
        FeatRelation::deleteAll(['character_id' => $characterId]);
        Inventory::deleteAll(['character_id' => $characterId]);
        LanguageRelation::deleteAll(['character_id' => $characterId]);
        FeatRelation::deleteAll(['character_id' => $characterId]);
        SkillRelation::deleteAll(['character_id' => $characterId]);
    }
}
