<?php

use yii\db\Migration;

/**
 * Class m200426_133520_add_race_columns
 */
class m200426_133520_add_race_columns extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('race', 'speed', $this->integer());
        $this->addColumn('race', 'size', $this->string());
        $this->addColumn('race', 'ability_score_strength', $this->integer()->defaultValue(0)->notNull());
        $this->addColumn('race', 'ability_score_dexterity', $this->integer()->defaultValue(0)->notNull());
        $this->addColumn('race', 'ability_score_constitution', $this->integer()->defaultValue(0)->notNull());
        $this->addColumn('race', 'ability_score_intelligence', $this->integer()->defaultValue(0)->notNull());
        $this->addColumn('race', 'ability_score_wisdom', $this->integer()->defaultValue(0)->notNull());
        $this->addColumn('race', 'ability_score_charisma', $this->integer()->defaultValue(0)->notNull());
        $this->addColumn('race', 'age', $this->string());
        $this->addColumn('race', 'alignment', $this->string());
        $this->addColumn('race', 'language_choice', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn('race', 'speed');
        $this->dropColumn('race', 'size');
        $this->dropColumn('race', 'ability_score_strength');
        $this->dropColumn('race', 'ability_score_dexterity');
        $this->dropColumn('race', 'ability_score_constitution');
        $this->dropColumn('race', 'ability_score_intelligence');
        $this->dropColumn('race', 'ability_score_wisdom');
        $this->dropColumn('race', 'ability_score_charisma');
        $this->dropColumn('race', 'age');
        $this->dropColumn('race', 'alignment');
        $this->dropColumn('race', 'language_choice');
    }
}
