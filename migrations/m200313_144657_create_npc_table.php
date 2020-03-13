<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%npc}}`.
 */
class m200313_144657_create_npc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%npc}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'class_id' => $this->integer(),
            'race_id' => $this->integer(),
            'campaign_id' => $this->integer(),
            'created_at' => $this->dateTime(). ' DEFAULT NOW()',
            'updated_at' => $this->dateTime(). ' DEFAULT NOW()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%npc}}');
    }
}
