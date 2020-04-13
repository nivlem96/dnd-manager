<?php

use yii\db\Migration;

/**
 * Class m200412_155430_add_hitpoints_columns
 */
class m200412_155430_add_hitpoints_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('character', 'max_hitpoints', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('character', 'current_hitpoints', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('character_class', 'hitdice', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('character_class', 'hitdice');
        $this->dropColumn('character', 'current_hitpoints');
        $this->dropColumn('character', 'max_hitpoints');
    }
}
