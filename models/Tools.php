<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tools".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $proficiency_id
 * @property int|null $cost
 * @property int|null $weight
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Proficiency $proficiency
 */
class Tools extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tools';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['proficiency_id', 'cost', 'weight'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['proficiency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proficiency::className(), 'targetAttribute' => ['proficiency_id' => 'id']],
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
            'proficiency_id' => 'Proficiency ID',
            'cost' => 'Cost',
            'weight' => 'Weight',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Proficiency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProficiency()
    {
        return $this->hasOne(Proficiency::className(), ['id' => 'proficiency_id']);
    }
}
