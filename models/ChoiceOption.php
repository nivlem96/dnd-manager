<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "choice_option".
 *
 * @property int $id
 * @property int|null $choice_id
 * @property string|null $equipment_type
 * @property int|null $equipment_id
 *
 * @property Choice $choice
 */
class ChoiceOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'choice_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['choice_id', 'equipment_id'], 'integer'],
            [['equipment_type'], 'string', 'max' => 255],
            [['choice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Choice::className(), 'targetAttribute' => ['choice_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'choice_id' => 'Choice ID',
            'equipment_type' => 'Equipment Type',
            'equipment_id' => 'Equipment ID',
        ];
    }

    /**
     * Gets query for [[Choice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChoice()
    {
        return $this->hasOne(Choice::className(), ['id' => 'choice_id']);
    }
}
