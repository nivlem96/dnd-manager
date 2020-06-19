<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proficiency".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Armor[] $armors
 * @property CharacterProficiencyRelation[] $characterProficiencyRelations
 * @property Item[] $items
 * @property ProficiencyRelation[] $proficiencyRelations
 * @property Weapon[] $weapons
 */
class Proficiency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proficiency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
        ];
    }

    /**
     * Gets query for [[Armors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArmors()
    {
        return $this->hasMany(Armor::className(), ['proficiency_id' => 'id']);
    }

    /**
     * Gets query for [[CharacterProficiencyRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterProficiencyRelations()
    {
        return $this->hasMany(CharacterProficiencyRelation::className(), ['proficiency_id' => 'id']);
    }

    /**
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['proficiency_id' => 'id']);
    }

    /**
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTools()
    {
        return $this->hasMany(Tools::className(), ['proficiency_id' => 'id']);
    }

    /**
     * Gets query for [[ProficiencyRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProficiencyRelations()
    {
        return $this->hasMany(ProficiencyRelation::className(), ['proficiency_id' => 'id']);
    }

    /**
     * Gets query for [[Weapons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWeapons()
    {
        return $this->hasMany(Weapon::className(), ['proficiency_id' => 'id']);
    }
}
