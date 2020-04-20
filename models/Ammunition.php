<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ammunition".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $type
 * @property string|null $cost
 * @property float|null $weight
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by_user_id
 *
 * @property User $createdByUser
 */
class Ammunition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ammunition';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['weight'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by_user_id'], 'integer'],
            [['name', 'description', 'type', 'cost'], 'string', 'max' => 255],
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
            'type' => 'Type',
            'cost' => 'Cost',
            'weight' => 'Weight',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by_user_id' => 'Created By User ID',
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
}
