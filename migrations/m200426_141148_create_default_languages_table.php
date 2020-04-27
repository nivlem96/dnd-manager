<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%default_languages}}`.
 */
class m200426_141148_create_default_languages_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%default_languages}}', [
            'id' => $this->primaryKey(),
            'language_id' => $this->integer()->notNull(),
            'race_id' => $this->integer(),
            'background_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%default_languages}}');
    }
}
