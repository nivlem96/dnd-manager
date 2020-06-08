<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventory".
 *
 * @property int $id
 * @property int $character_id
 * @property string $equipment_table
 * @property int $equipment_id
 * @property int $equipped
 * @property int $quantity
 *
 * @property Character $character
 */
class Inventory extends \yii\db\ActiveRecord
{
    public $itemId;
    public $armorId;
    public $weaponId;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['character_id', 'equipment_table', 'equipment_id'], 'required'],
            [['character_id', 'equipment_id'], 'integer'],
            [['equipment_table'], 'string', 'max' => 255],
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Character::className(), 'targetAttribute' => ['character_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'character_id' => 'Character ID',
            'equipment_table' => 'Equipment Table',
            'equipment_id' => 'Equipment ID',
        ];
    }

    /**
     * Gets query for [[Character]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacter()
    {
        return $this->hasOne(Character::className(), ['id' => 'character_id']);
    }

    public function getEquipment(){
        $className = strtolower($this->equipment_table);
        switch ($className){
            case 'weapon':
                $class = Weapon::className();
                break;
            case 'armor':
                $class = Armor::className();
                break;
            case 'item':
                $class = Item::className();
                break;
        }
        return $this->hasOne($class, ['id' => 'equipment_id']);
    }
}
