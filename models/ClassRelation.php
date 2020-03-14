<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "class_relation".
 *
 * @property int $id
 * @property int $class_id
 * @property int $character_id
 * @property int $level
 */
class ClassRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'character_id'], 'required'],
            [['class_id', 'character_id', 'level'], 'integer'],
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
            'character_id' => 'Character ID',
            'level' => 'Level',
        ];
    }
}
