<?php

use yii\db\Migration;

/**
 * Class m200313_151033_add_foreign_keys_to_npc_table
 */
class m200313_151033_add_foreign_keys_to_npc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-npc-class',
            'npc',
            'class_id',
            'character_class',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-npc-race',
            'npc',
            'race_id',
            'race',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-npc-campaign',
            'npc',
            'campaign_id',
            'campaign',
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
            'fk-npc-class',
            'npc'
        );
        $this->dropForeignKey(
            'fk-npc-race',
            'npc'
        );
        $this->dropForeignKey(
            'fk-npc-campaign',
            'npc'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200313_151033_add_foreign_keys_to_npc_table cannot be reverted.\n";

        return false;
    }
    */
}
