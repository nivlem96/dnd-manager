<?php

use yii\db\Migration;

/**
 * Class m200313_150639_add_foreign_keys_to_encounter_table
 */
class m200313_150639_add_foreign_keys_to_encounter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-encounter-event',
            'encounter',
            'event_id',
            'event',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-encounter-campaign',
            'encounter',
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
            'fk-encounter-event',
            'encounter'
        );
        $this->dropForeignKey(
            'fk-encounter-campaign',
            'encounter'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200313_150639_add_foreign_keys_to_encounter_table cannot be reverted.\n";

        return false;
    }
    */
}
