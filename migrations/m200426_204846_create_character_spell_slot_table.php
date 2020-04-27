<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%character_spell_slot}}`.
 */
class m200426_204846_create_character_spell_slot_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%character_spell_slot}}', [
            'id' => $this->primaryKey(),
            'cantrips' => $this->integer(),
            'cantrips_remaining' => $this->integer(),
            '1st' => $this->integer(),
            '1st_remaining' => $this->integer(),
            '2nd' => $this->integer(),
            '2nd_remaining' => $this->integer(),
            '3rd' => $this->integer(),
            '3rd_remaining' => $this->integer(),
            '4th' => $this->integer(),
            '4th_remaining' => $this->integer(),
            '5th' => $this->integer(),
            '5th_remaining' => $this->integer(),
            '6th' => $this->integer(),
            '6th_remaining' => $this->integer(),
            '7th' => $this->integer(),
            '7th_remaining' => $this->integer(),
            '8th' => $this->integer(),
            '8th_remaining' => $this->integer(),
            '9th' => $this->integer(),
            '9th_remaining' => $this->integer(),
            'created_at' => $this->dateTime(). ' DEFAULT NOW()',
            'updated_at' => $this->dateTime(). ' DEFAULT NOW()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%character_spell_slot}}');
    }
}
