<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%skill_relation}}`.
 */
class m200426_201002_create_skill_relation_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%skill_relation}}', [
            'id' => $this->primaryKey(),
            'skill_id' => $this->integer(),
            'character_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%skill_relation}}');
    }
}
