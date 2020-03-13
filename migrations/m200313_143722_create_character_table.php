<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%character}}`.
 */
class m200313_143722_create_character_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%character}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'background' => $this->text(),
            'class_id' => $this->integer(),
            'race_id' => $this->integer(),
            'player_id' => $this->integer(),
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
        $this->dropTable('{{%character}}');
    }
}
