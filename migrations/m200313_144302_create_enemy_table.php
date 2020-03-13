<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%enemy}}`.
 */
class m200313_144302_create_enemy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%enemy}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->dateTime(). ' DEFAULT NOW()',
            'updated_at' => $this->dateTime(). ' DEFAULT NOW()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%enemy}}');
    }
}
