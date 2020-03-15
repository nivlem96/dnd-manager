<?php

use yii\db\Migration;

/**
 * Class m200315_130741_add_foreign_keys_to_class_relation_table
 */
class m200315_130741_add_foreign_keys_to_class_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-class_relation-character',
            'class_relation',
            'character_id',
            'character',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-class_relation-class',
            'class_relation',
            'class_id',
            'character_class',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-class_relation-character',
            'class_relation'
        );
        $this->dropForeignKey(
            'fk-class_relation-class',
            'class_relation'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200315_130741_add_foreign_keys_to_class_relation_table cannot be reverted.\n";

        return false;
    }
    */
}
