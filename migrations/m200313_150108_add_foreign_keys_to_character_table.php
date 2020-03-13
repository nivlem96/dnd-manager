<?php

use yii\db\Migration;

/**
 * Class m200313_150108_add_foreign_keys_to_character_table
 */
class m200313_150108_add_foreign_keys_to_character_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-character-class',
            'character',
            'class_id',
            'character_class',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-character-race',
            'character',
            'race_id',
            'race',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-character-user',
            'character',
            'player_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-character-campaign',
            'character',
            'campaign_id',
            'campaign',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-character-class',
            'character'
        );
        $this->dropForeignKey(
            'fk-character-race',
            'character'
        );
        $this->dropForeignKey(
            'fk-character-user',
            'character'
        );
        $this->dropForeignKey(
            'fk-character-campaign',
            'character'
        );
    }
}
