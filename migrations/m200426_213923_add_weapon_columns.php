<?php

use yii\db\Migration;

/**
 * Class m200426_213923_add_weapon_columns
 */
class m200426_213923_add_weapon_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('weapon','proficiency_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('weapon','proficiency_id');
    }
}
