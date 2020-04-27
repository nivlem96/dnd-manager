<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%spell_slot}}`.
 */
class m200426_204751_create_spell_slot_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%spell_slot}}', [
            'id' => $this->primaryKey(),
            'class_id' => $this->integer(),
            'level' => $this->integer(),
            'cantrips' => $this->integer(),
            '1st' => $this->integer(),
            '2nd' => $this->integer(),
            '3rd' => $this->integer(),
            '4th' => $this->integer(),
            '5th' => $this->integer(),
            '6th' => $this->integer(),
            '7th' => $this->integer(),
            '8th' => $this->integer(),
            '9th' => $this->integer(),
            'created_at' => $this->dateTime(). ' DEFAULT NOW()',
            'updated_at' => $this->dateTime(). ' DEFAULT NOW()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%spell_slot}}');
    }
}
