<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "character".
 *
 * @property int $id
 * @property string $name
 * @property int $class_id
 * @property int $race_id
 * @property string|null $background
 * @property int $player_id
 * @property int|null $campaign_id
 *
 * @property Campaign $campaign
 * @property User $player
 */
class Character extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'character';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'class_id', 'race_id', 'player_id'], 'required'],
            [['class_id', 'race_id', 'player_id', 'campaign_id'], 'integer'],
            [['background'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['campaign_id'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::className(), 'targetAttribute' => ['campaign_id' => 'id']],
            [['player_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['player_id' => 'id']],
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
            'class_id' => 'Class ID',
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
    public function getCampaign()
    {
        return $this->hasOne(Campaign::className(), ['id' => 'campaign_id']);
    }

    /**
     * Gets query for [[Player]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(User::className(), ['id' => 'player_id']);
    }
}
