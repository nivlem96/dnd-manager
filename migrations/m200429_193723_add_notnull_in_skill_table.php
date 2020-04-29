<?php

use yii\db\Migration;

/**
 * Class m200429_193723_add_notnull_in_skill_table
 */
class m200429_193723_add_notnull_in_skill_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('skill','name',$this->string()->notNull());
        $this->alterColumn('skill','stat',$this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('skill','name',$this->text());
        $this->alterColumn('skill','stat',$this->string());
    }
}
