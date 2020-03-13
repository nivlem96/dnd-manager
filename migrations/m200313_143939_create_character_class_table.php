<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%character_class}}`.
 */
class m200313_143939_create_character_class_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%character_class}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_by_user_id' => $this->integer(),
            'created_at' => $this->dateTime(). ' DEFAULT NOW()',
            'updated_at' => $this->dateTime(). ' DEFAULT NOW()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%character_class}}');
    }
}
