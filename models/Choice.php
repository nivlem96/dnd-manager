<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "choice".
 *
 * @property int $id
 * @property int|null $relation_id
 * @property string|null $relation_class
 * @property string|null $choice_type
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
            [['relation_class','choice_type'], 'string'],
            [['relation_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'relation_class' => 'Relation Class',
            'relation_id' => 'Relation ID',
        ];
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
