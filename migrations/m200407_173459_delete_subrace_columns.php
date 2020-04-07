<?php

use yii\db\Migration;

/**
 * Class m200407_173459_delete_subrace_columns
 */
class m200407_173459_delete_subrace_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey(
            'fk-feat-sub_race',
            'feat'
        );
        $this->dropForeignKey(
            'fk-character-sub_race',
            'character'
        );
        $this->dropColumn('feat', 'sub_race_id');
        $this->dropColumn('character', 'sub_race_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('character', 'sub_race_id', $this->integer());
        $this->addColumn('feat', 'sub_race_id', $this->integer());
        $this->addForeignKey(
            'fk-character-sub_race',
            'character',
            'sub_race_id',
            'sub_race',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-feat-sub_race',
            'feat',
            'sub_race_id',
            'sub_race',
            'id',
            'CASCADE'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200407_173459_delete_subrace_columns cannot be reverted.\n";

        return false;
    }
    */
}
