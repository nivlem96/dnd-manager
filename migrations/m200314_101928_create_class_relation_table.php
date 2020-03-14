<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%class_relation}}`.
 */
class m200314_101928_create_class_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%class_relation}}', [
            'id' => $this->primaryKey(),
            'class_id' =>$this->integer()->notNull(),
            'character_id' =>$this->integer()->notNull(),
            'level' => $this->integer()->notNull()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%class_relation}}');
    }
}
