<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%choice}}`.
 */
class m200427_195449_create_choice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%choice}}', [
            'id' => $this->primaryKey(),
            'class_id' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%choice}}');
    }
}
