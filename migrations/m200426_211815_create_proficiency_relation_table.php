<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%proficiency_relation}}`.
 */
class m200426_211815_create_proficiency_relation_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%proficiency_relation}}', [
            'id' => $this->primaryKey(),
            'proficiency_id' => $this->integer(),
            'race_id' => $this->integer(),
            'class_id' => $this->integer(),
            'background_id' => $this->integer(),
            'choice' => $this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%proficiency_relation}}');
    }
}
