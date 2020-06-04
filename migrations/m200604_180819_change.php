<?php

use yii\db\Migration;

/**
 * Class m200604_180819_change
 */
class m200604_180819_change extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-choice-class', 'choice');
        $this->dropColumn('choice','class_id');
        $this->addColumn('choice','relation_class',$this->string());
        $this->addColumn('choice','relation_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('choice','relation_id');
        $this->dropColumn('choice','relation_class');
        $this->addColumn('choice','class_id',$this->integer());
        $this->addForeignKey(
            'fk-choice-class',
            'choice',
            'class_id',
            'character_class',
            'id'
        );
    }
}
