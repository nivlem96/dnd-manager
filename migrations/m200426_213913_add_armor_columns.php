<?php

use yii\db\Migration;

/**
 * Class m200426_213913_add_armor_columns
 */
class m200426_213913_add_armor_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('armor','proficiency_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('armor','proficiency_id');
    }
}
