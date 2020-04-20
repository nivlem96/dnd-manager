<?php

use yii\db\Migration;

/**
 * Class m200420_152252_add_item_table
 */
class m200420_152252_add_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('item','description',$this->string());
        $this->addColumn('item','type',$this->string());
        $this->addColumn('item','cost',$this->string());
        $this->addColumn('item','weight',$this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('item','weight');
        $this->dropColumn('item','cost');
        $this->dropColumn('item','type');
        $this->dropColumn('item','description');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200420_152252_add_item_table cannot be reverted.\n";

        return false;
    }
    */
}
