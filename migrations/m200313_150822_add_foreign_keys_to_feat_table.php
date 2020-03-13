<?php

use yii\db\Migration;

/**
 * Class m200313_150822_add_foreign_keys_to_feat_table
 */
class m200313_150822_add_foreign_keys_to_feat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-feat-class',
            'feat',
            'class_id',
            'character_class',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-feat-race',
            'feat',
            'race_id',
            'race',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-feat-user',
            'feat',
            'created_by_user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-feat-class',
            'feat'
        );
        $this->dropForeignKey(
            'fk-feat-race',
            'feat'
        );
        $this->dropForeignKey(
            'fk-feat-user',
            'feat'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200313_150822_add_foreign_keys_to_feat_table cannot be reverted.\n";

        return false;
    }
    */
}
