<?php

use yii\db\Migration;

/**
 * Class m200328_150803_add_sub_race_columns_and_relations_table
 */
class m200328_150803_add_sub_race_columns_and_relations_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
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

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200328_150803_add_sub_race_columns_and_relations_table cannot be reverted.\n";

        return false;
    }
    */
}
