<?php

use yii\db\Migration;

/**
 * Class m200428_202748_add_foreign_keys
 */
class m200428_202748_add_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-default_languages-race',
            'default_languages',
            'race_id',
            'race',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-default_languages-race', 'default_languages');
    }
}
