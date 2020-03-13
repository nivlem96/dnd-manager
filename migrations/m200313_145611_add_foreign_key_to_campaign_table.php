<?php

use yii\db\Migration;

/**
 * Class m200313_145611_add_foreign_key_to_campaign_table
 */
class m200313_145611_add_foreign_key_to_campaign_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-campaign-user',
            'campaign',
            'dm_id',
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
            'fk-campaign-user',
            'campaign'
        );
    }
}
