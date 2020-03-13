<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%spell}}`.
 */
class m200313_144851_create_spell_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%spell}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'level' => $this->integer()->defaultValue(0),
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
        $this->dropTable('{{%spell}}');
    }
}
