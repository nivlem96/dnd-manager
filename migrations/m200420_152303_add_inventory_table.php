<?php

use yii\db\Migration;

/**
 * Class m200420_152303_add_item_relation_table
 */
class m200420_152303_add_inventory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%inventory}}', [
            'id' => $this->primaryKey(),
            'character_id' =>$this->integer()->notNull(),
            'equipment_table' =>$this->string()->notNull(),
            'equipment_id' =>$this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'fk-inventory-character',
            'inventory',
            'character_id',
            'character',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-inventory-race',
            'inventory'
        );
        $this->dropTable('{{%inventory}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200420_152303_add_item_relation_table cannot be reverted.\n";

        return false;
    }
    */
}
