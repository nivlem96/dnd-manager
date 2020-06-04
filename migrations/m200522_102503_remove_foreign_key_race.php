<?php

use yii\db\Migration;

/**
 * Class m200522_102503_remove_foreign_key_race
 */
class m200522_102503_remove_foreign_key_race extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-race-race', 'race');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addForeignKey(
            'fk-race-race',
            'race',
            'parent_id',
            'race',
            'id'
        );
    }
}
