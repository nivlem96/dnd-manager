<?php

use yii\db\Migration;

/**
 * Class m200313_151250_add_foreign_key_to_spell_table
 */
class m200313_151250_add_foreign_key_to_spell_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-spell-user',
            'spell',
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
            'fk-spell-user',
            'feat'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200313_151250_add_foreign_key_to_spell_table cannot be reverted.\n";

        return false;
    }
    */
}
