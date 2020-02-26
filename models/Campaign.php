<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campaign".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $dm_id
 *
 * @property User $dm
 */
class Campaign extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'campaign';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id', 'dm_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['dm_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['dm_id' => 'id']],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'dm_id' => 'Dm ID',
        ];
    }

    /**
     * Gets query for [[Dm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDm()
    {
        return $this->hasOne(User::className(), ['id' => 'dm_id']);
    }

    public function getEvents()
    {
        return $this->hasMany(Event::className(),['id'=>'campaign_id']);
    }
}
