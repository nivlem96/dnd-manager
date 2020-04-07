<?php

use yii\db\Migration;

/**
 * Class m200407_174525_add_parent_id_to_race_table
 */
class m200407_174525_add_parent_id_to_race_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('race', 'parent_id', $this->integer());
        $this->addForeignKey(
            'fk-race-race',
            'race',
            'parent_id',
            'race',
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
            'fk-race-race',
            'race'
        );
        $this->dropColumn('race', 'parent_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200407_174525_add_parent_id_to_race_table cannot be reverted.\n";

        return false;
    }
    */
}
