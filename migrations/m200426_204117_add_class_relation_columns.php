<?php

use yii\db\Migration;

/**
 * Class m200426_204117_add_class_relation_columns
 */
class m200426_204117_add_class_relation_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('class_relation','rages',$this->integer());
        $this->addColumn('class_relation','rage_damage',$this->integer());
        $this->addColumn('class_relation','martial_arts',$this->string());
        $this->addColumn('class_relation','ki_points',$this->integer());
        $this->addColumn('class_relation','unarmored_movement',$this->integer());
        $this->addColumn('class_relation','sneak_attack',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('class_relation','rages');
        $this->dropColumn('class_relation','rage_damage');
        $this->dropColumn('class_relation','martial_arts');
        $this->dropColumn('class_relation','ki_points');
        $this->dropColumn('class_relation','unarmored_movement');
        $this->dropColumn('class_relation','sneak_attack');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200426_204117_add_class_relation_columns cannot be reverted.\n";

        return false;
    }
    */
}
