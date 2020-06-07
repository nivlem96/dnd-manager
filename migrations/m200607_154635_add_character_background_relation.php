<?php

use yii\db\Migration;

/**
 * Class m200607_154635_add_character_background_relation
 */
class m200607_154635_add_character_background_relation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('character','background_id',$this->integer()->notNull());
        $this->addForeignKey(
            'fk-character-background',
            'character',
            'background_id',
            'background',
            'id'
        );
        $this->dropColumn('character','background');
        $this->addColumn('character','backstory',$this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('character','backstory');
        $this->addColumn('character','background',$this->text());
        $this->dropForeignKey('fk-character-background', 'character');
        $this->dropColumn('character','background_id');
    }
}
