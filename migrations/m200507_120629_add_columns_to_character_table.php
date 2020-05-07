<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%character}}`.
 */
class m200507_120629_add_columns_to_character_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('character','speed',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('character','speed');
    }
}
