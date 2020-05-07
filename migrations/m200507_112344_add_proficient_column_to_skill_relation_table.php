<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%skill_relation}}`.
 */
class m200507_112344_add_proficient_column_to_skill_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('skill_relation','proficient',$this->tinyInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('skill_relation','proficient');
    }
}
