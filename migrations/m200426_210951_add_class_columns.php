<?php

use yii\db\Migration;

/**
 * Class m200426_210951_add_class_columns
 */
class m200426_210951_add_class_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('character_class','saving_throws',$this->json());
        $this->addColumn('character_class','skill_choices',$this->integer());
        $this->addColumn('character_class','spell_stat',$this->string());
        $this->addColumn('character_class','parent_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('character_class','saving_throws');
        $this->dropColumn('character_class','skill_choices');
        $this->dropColumn('character_class','spell_stat');
        $this->dropColumn('character_class','parent_id');
    }
}
