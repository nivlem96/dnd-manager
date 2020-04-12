<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%character}}`.
 */
class m200412_101148_add_stats_columns_to_character_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('character', 'strength', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('character', 'dexterity', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('character', 'constitution', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('character', 'intelligence', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('character', 'wisdom', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('character', 'charisma', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('character', 'charisma');
        $this->dropColumn('character', 'wisdom');
        $this->dropColumn('character', 'intelligence');
        $this->dropColumn('character', 'constitution');
        $this->dropColumn('character', 'dexterity');
        $this->dropColumn('character', 'strength');
    }
}
