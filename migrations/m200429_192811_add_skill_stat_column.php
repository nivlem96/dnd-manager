<?php

use yii\db\Migration;

/**
 * Class m200429_192811_add_skill_stat_column
 */
class m200429_192811_add_skill_stat_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('skill','stat',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('skill','stat');
    }
}
