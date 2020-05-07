<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feat".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $unlocked_at
 * @property int|null $class_id
 * @property int|null $race_id
 * @property int|null $created_by_user_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $counter
 * @property string|null $counter_type
 * @property string|null $damage
 *
 * @property CharacterClass $class
 * @property Race $race
 * @property User $createdByUser
 * @property FeatRelation[] $featRelations
 */
class Feat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['unlocked_at', 'class_id', 'race_id', 'created_by_user_id', 'counter'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            ['class_id', 'either', 'params' => ['other' => 'race_id']],
            [['name', 'counter_type', 'damage'], 'string', 'max' => 255],
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
            'unlocked_at' => 'Unlocked At',
            'class_id' => 'Class ID',
            'race_id' => 'Race ID',
            'created_by_user_id' => 'Created By User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'counter' => 'Counter',
            'counter_type' => 'Counter Type',
            'damage' => 'Damage',
        ];
    }

    public function either($attribute_name, $params)
    {
        $field1 = $this->getAttributeLabel($attribute_name);
        $field2 = $this->getAttributeLabel($params['other']);
        if (empty($this->$attribute_name) && empty($this->{$params['other']})) {
            $this->addError($attribute_name, "either {$field1} or {$field2} is required.");
        }
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
     * Gets query for [[Race]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
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
     * Gets query for [[FeatRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeatRelations()
    {
        return $this->hasMany(FeatRelation::className(), ['feat_id' => 'id']);
    }
}
