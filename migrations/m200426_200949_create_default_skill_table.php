<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%default_skill}}`.
 */
class m200426_200949_create_default_skill_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%default_skill}}', [
            'id' => $this->primaryKey(),
            'skill_id' => $this->integer()->notNull(),
            'race_id' => $this->integer(),
            'class_id' => $this->integer(),
            'background_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%default_skill}}');
    }
}
