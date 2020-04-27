<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%character_proficiency_relation}}`.
 */
class m200426_211952_create_character_proficiency_relation_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%character_proficiency_relation}}', [
            'id' => $this->primaryKey(),
            'character_id' => $this->integer(),
            'proficiency_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%character_proficiency_relation}}');
    }
}
