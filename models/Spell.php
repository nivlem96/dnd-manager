<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spell".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $level
 */
class Spell extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spell';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['level'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'level' => 'Level',
        ];
    }

    public static function getUserAvailableSpells($id) {
        return Spell::find()
            ->where(['created_by_user_id' => $id])
            ->orWhere(['created_by_user_id' => null]);
    }
}
