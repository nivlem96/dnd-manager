<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $description
 * @property string|null $type
 * @property string|null $cost
 * @property float|null $weight
 * @property int|null $created_by_user_id
 * @property int|null $proficiency_id
 *
 * @property User $createdByUser
 * @property Proficiency $proficiency
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['weight'], 'number'],
            [['created_by_user_id', 'proficiency_id'], 'integer'],
            [['name', 'description', 'type', 'cost'], 'string', 'max' => 255],
            [['created_by_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by_user_id' => 'id']],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'description' => 'Description',
            'type' => 'Type',
            'cost' => 'Cost',
            'weight' => 'Weight',
            'created_by_user_id' => 'Created By User ID',
            'proficiency_id' => 'Proficiency ID',
        ];
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
