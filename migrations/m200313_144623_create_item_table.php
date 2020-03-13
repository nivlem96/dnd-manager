<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item}}`.
 */
class m200313_144623_create_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item}}', [
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
        $this->dropTable('{{%item}}');
    }
}
