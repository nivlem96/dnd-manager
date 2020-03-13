<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%encounter}}`.
 */
class m200313_144025_create_encounter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%encounter}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'event_id' => $this->integer(),
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
        $this->dropTable('{{%encounter}}');
    }
}
