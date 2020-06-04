<?php

use yii\db\Migration;

/**
 * Class m200604_182607_insert_skills
 */
class m200604_182607_insert_skills extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('skill',[
            'name'=> 'Acrobatics',
            'stat'=> 'dexterity',
        ]);
        $this->insert('skill',[
            'name'=> 'Animal Handling',
            'stat'=> 'wisdom',
        ]);
        $this->insert('skill',[
            'name'=> 'Arcana',
            'stat'=> 'intelligence',
        ]);
        $this->insert('skill',[
            'name'=> 'Athletics',
            'stat'=> 'strength',
        ]);
        $this->insert('skill',[
            'name'=> 'Deception',
            'stat'=> 'charisma',
        ]);
        $this->insert('skill',[
            'name'=> 'History',
            'stat'=> 'intelligence',
        ]);
        $this->insert('skill',[
            'name'=> 'Insight',
            'stat'=> 'wisdom',
        ]);
        $this->insert('skill',[
            'name'=> 'Intimidation',
            'stat'=> 'charisma',
        ]);
        $this->insert('skill',[
            'name'=> 'Investigation',
            'stat'=> 'intelligence',
        ]);
        $this->insert('skill',[
            'name'=> 'Medicine',
            'stat'=> 'wisdom',
        ]);
        $this->insert('skill',[
            'name'=> 'Nature',
            'stat'=> 'intelligence',
        ]);
        $this->insert('skill',[
            'name'=> 'Perception',
            'stat'=> 'wisdom',
        ]);
        $this->insert('skill',[
            'name'=> 'Performance',
            'stat'=> 'charisma',
        ]);
        $this->insert('skill',[
            'name'=> 'Persuasion',
            'stat'=> 'charisma',
        ]);
        $this->insert('skill',[
            'name'=> 'Religion',
            'stat'=> 'intelligence',
        ]);
        $this->insert('skill',[
            'name'=> 'Sleight of Hand',
            'stat'=> 'dexterity',
        ]);
        $this->insert('skill',[
            'name'=> 'Stealth',
            'stat'=> 'dexterity',
        ]);
        $this->insert('skill',[
            'name'=> 'Survival',
            'stat'=> 'wisdom',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return false;
    }
}
