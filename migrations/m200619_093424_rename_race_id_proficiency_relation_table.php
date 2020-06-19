<?php

use yii\db\Migration;

/**
 * Class m200619_093424_rename_race_id_proficiency_relation_table
 */
class m200619_093424_rename_race_id_proficiency_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-proficiency_relation-race','proficiency_relation');
        $this->dropColumn('proficiency_relation','race_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('proficiency_relation','race_id',$this->integer());
        $this->addForeignKey(
            'fk-proficiency_relation-race',
            'proficiency_relation',
            'race_id',
            'race',
            'id'
        );

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200619_093424_rename_race_id_proficiency_relation_table cannot be reverted.\n";

        return false;
    }
    */
}
