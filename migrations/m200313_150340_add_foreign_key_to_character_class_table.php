<?php

use yii\db\Migration;

/**
 * Class m200313_150340_add_foreign_key_to_character_class_table
 */
class m200313_150340_add_foreign_key_to_character_class_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-class-user',
            'character_class',
            'created_by_user_id',
            'user',
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
            'fk-class-user',
            'character_class'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200313_150340_add_foreign_key_to_character_class_table cannot be reverted.\n";

        return false;
    }
    */
}
