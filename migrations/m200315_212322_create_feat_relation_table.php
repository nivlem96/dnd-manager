<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feat_relation}}`.
 */
class m200315_212322_create_feat_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%feat_relation}}', [
            'id' => $this->primaryKey(),
            'feat_id' => $this->integer()->notNull(),
            'character_id' => $this->integer()->notNull(),
            'class_id' => $this->integer(),
            'race_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-feat_relation-feat',
            'feat_relation',
            'feat_id',
            'feat',
            'id'
        );
        $this->addForeignKey(
            'fk-feat_relation-character',
            'feat_relation',
            'character_id',
            'character',
            'id'
        );
        $this->addForeignKey(
            'fk-feat_relation-character_class',
            'feat_relation',
            'class_id',
            'character_class',
            'id'
        );
        $this->addForeignKey(
            'fk-feat_relation-race',
            'feat_relation',
            'race_id',
            'race',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-feat_relation-race',
            'feat_relation'
        );
        $this->dropForeignKey(
            'fk-feat_relation-character',
            'feat_relation'
        );
        $this->dropForeignKey(
            'fk-feat_relation-character_class',
            'feat_relation'
        );
        $this->dropForeignKey(
            'fk-feat_relation-feat',
            'feat_relation'
        );
        $this->dropTable('{{%feat_relation}}');
    }
}
