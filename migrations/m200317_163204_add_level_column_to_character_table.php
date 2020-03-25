<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%character}}`.
 */
class m200317_163204_add_level_column_to_character_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('character', 'level', $this->integer()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn('character', 'level');
    }
}
