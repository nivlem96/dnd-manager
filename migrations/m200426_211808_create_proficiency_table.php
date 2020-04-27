<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%proficiency}}`.
 */
class m200426_211808_create_proficiency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%proficiency}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%proficiency}}');
    }
}
