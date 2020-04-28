<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "choice".
 *
 * @property int $id
 * @property int|null $class_id
 *
 * @property CharacterClass $class
 * @property ChoiceOption[] $choiceOptions
 */
class Choice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'choice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id'], 'integer'],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => CharacterClass::className(), 'targetAttribute' => ['class_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_id' => 'Class ID',
        ];
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
     * Gets query for [[ChoiceOptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChoiceOptions()
    {
        return $this->hasMany(ChoiceOption::className(), ['choice_id' => 'id']);
    }
}
