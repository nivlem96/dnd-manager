<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feat_relation".
 *
 * @property int $id
 * @property int $feat_id
 * @property int $character_id
 * @property int|null $class_id
 * @property int|null $race_id
 * @property int|null $counter
 * @property int|null $counter_max
 * @property string|null $counter_type
 * @property string|null $damage
 *
 * @property Character $character
 * @property CharacterClass $class
 * @property Feat $feat
 * @property Race $race
 */
class FeatRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feat_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['feat_id', 'character_id'], 'required'],
            [['feat_id', 'character_id', 'class_id', 'race_id', 'counter', 'counter_max'], 'integer'],
            [['counter_type', 'damage'], 'string', 'max' => 255],
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Character::className(), 'targetAttribute' => ['character_id' => 'id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => CharacterClass::className(), 'targetAttribute' => ['class_id' => 'id']],
            [['feat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Feat::className(), 'targetAttribute' => ['feat_id' => 'id']],
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
            'feat_id' => 'Feat ID',
            'character_id' => 'Character ID',
            'class_id' => 'Class ID',
            'race_id' => 'Race ID',
            'counter' => 'Counter',
            'counter_max' => 'Counter Max',
            'counter_type' => 'Counter Type',
            'damage' => 'Damage',
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
     * Gets query for [[Class]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(CharacterClass::className(), ['id' => 'class_id']);
    }

    /**
     * Gets query for [[Feat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeat()
    {
        return $this->hasOne(Feat::className(), ['id' => 'feat_id']);
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
