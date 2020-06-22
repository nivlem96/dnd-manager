<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%background}}`.
 */
class m200622_122032_add_proficiency_choice_number_column_to_background_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('background', 'choice_proficiencies_number', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn('background', 'choice_proficiencies_number');
    }
}
