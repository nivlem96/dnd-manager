<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tools}}`.
 */
class m200619_092546_create_tools_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%tools}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text(),
            'proficiency_id' => $this->integer(),
            'cost' => $this->integer(),
            'weight' => $this->integer(),
            'created_at' => $this->dateTime() . ' DEFAULT NOW()',
            'updated_at' => $this->dateTime() . ' DEFAULT NOW()',
            'created_by_user_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-tools-proficiency',
            'tools',
            'proficiency_id',
            'proficiency',
            'id'
        );
        $this->addForeignKey(
            'fk-tools-user',
            'tools',
            'created_by_user_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk-tools-proficiency','tools');
        $this->dropForeignKey('fk-tools-user','tools');
        $this->dropTable('{{%tools}}');
    }
}
