<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%choice_option}}`.
 */
class m200427_195456_create_choice_option_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%choice_option}}', [
            'id' => $this->primaryKey(),
            'choice_id' => $this->integer(),
            'equipment_type' => $this->string(),
            'equipment_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%choice_option}}');
    }
}
