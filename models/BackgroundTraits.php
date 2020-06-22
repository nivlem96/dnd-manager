<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "background_traits".
 *
 * @property int $id
 * @property int|null $background_id
 * @property string|null $trait_type
 * @property string|null $trait
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by_user_id
 *
 * @property Background $background
 */
class BackgroundTraits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'background_traits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['background_id', 'created_by_user_id'], 'integer'],
            [['trait'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['trait_type'], 'string', 'max' => 255],
            [['background_id'], 'exist', 'skipOnError' => true, 'targetClass' => Background::className(), 'targetAttribute' => ['background_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'background_id' => 'Background ID',
            'trait_type' => 'Trait Type',
            'trait' => 'Trait',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by_user_id' => 'Created By User ID',
        ];
    }

    /**
     * Gets query for [[Background]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBackground()
    {
        return $this->hasOne(Background::className(), ['id' => 'background_id']);
    }
}
