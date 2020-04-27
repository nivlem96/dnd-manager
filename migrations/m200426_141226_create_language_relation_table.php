<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%language_relation}}`.
 */
class m200426_141226_create_language_relation_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%language_relation}}', [
            'id' => $this->primaryKey(),
            'language_id' => $this->integer()->notNull(),
            'character_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%language_relation}}');
    }
}
