<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feat_level".
 *
 * @property int $id
 * @property int|null $feat_id
 * @property int|null $level
 * @property int|null $counter
 * @property string|null $die_number
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Feat $feat
 */
class FeatLevel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feat_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['feat_id', 'level', 'counter'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['die_number'], 'string', 'max' => 255],
            [['feat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Feat::className(), 'targetAttribute' => ['feat_id' => 'id']],
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
            'level' => 'Level',
            'counter' => 'Counter',
            'die_number' => 'Die number',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
}
