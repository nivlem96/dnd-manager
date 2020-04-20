<?php

use yii\db\Migration;

/**
 * Class m200420_185730_add_created_by_user_columns
 */
class m200420_185730_add_created_by_user_columns extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('ammunition', 'created_by_user_id', $this->integer());
        $this->addForeignKey(
            'fk-ammunition-character',
            'ammunition',
            'created_by_user_id',
            'user',
            'id'
        );
        $this->addColumn('armor', 'created_by_user_id', $this->integer());
        $this->addForeignKey(
            'fk-armor-character',
            'armor',
            'created_by_user_id',
            'user',
            'id'
        );
        $this->addColumn('item', 'created_by_user_id', $this->integer());
        $this->addForeignKey(
            'fk-item-character',
            'item',
            'created_by_user_id',
            'user',
            'id'
        );
        $this->addColumn('weapon', 'created_by_user_id', $this->integer());
        $this->addForeignKey(
            'fk-weapon-character',
            'weapon',
            'created_by_user_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk-weapon-character','weapon');
        $this->dropColumn('weapon','created_by_user_id');
        $this->dropForeignKey('fk-item-character','item');
        $this->dropColumn('item','created_by_user_id');
        $this->dropForeignKey('fk-armor-character','armor');
        $this->dropColumn('armor','created_by_user_id');
        $this->dropForeignKey('fk-ammunition-character','ammunition');
        $this->dropColumn('ammunition','created_by_user_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200420_185730_add_created_by_user_columns cannot be reverted.\n";

        return false;
    }
    */
}
