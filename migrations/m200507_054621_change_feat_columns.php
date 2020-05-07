<?php

use yii\db\Migration;

/**
 * Class m200507_054621_change_feat_columns
 */
class m200507_054621_change_feat_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('class_relation','rages');
        $this->dropColumn('class_relation','rage_damage');
        $this->dropColumn('class_relation','martial_arts');
        $this->dropColumn('class_relation','ki_points');
        $this->dropColumn('class_relation','unarmored_movement');
        $this->dropColumn('class_relation','sneak_attack');
        $this->addColumn('feat_relation','counter',$this->integer());
        $this->addColumn('feat_relation','counter_max',$this->integer());
        $this->addColumn('feat_relation','counter_type',$this->string());
        $this->addColumn('feat_relation','damage',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('class_relation','rages',$this->integer());
        $this->addColumn('class_relation','rage_damage',$this->integer());
        $this->addColumn('class_relation','martial_arts',$this->string());
        $this->addColumn('class_relation','ki_points',$this->integer());
        $this->addColumn('class_relation','unarmored_movement',$this->integer());
        $this->addColumn('class_relation','sneak_attack',$this->string());
        $this->dropColumn('feat_relation','counter');
        $this->dropColumn('feat_relation','counter_max');
        $this->dropColumn('feat_relation','counter_type');
        $this->dropColumn('feat_relation','damage');
    }
}
