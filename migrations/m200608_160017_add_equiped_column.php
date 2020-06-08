<?php

use yii\db\Migration;

/**
 * Class m200608_160017_add_equiped_column
 */
class m200608_160017_add_equiped_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('inventory','quantity',$this->integer()->defaultValue(1)->notNull());
        $this->addColumn('inventory','equipped',$this->tinyInteger()->defaultValue(0)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('inventory','quantity');
        $this->dropColumn('inventory','equipped');
    }
}
