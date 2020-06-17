<?php

use yii\db\Migration;

/**
 * Class m200617_092320_rename_language_column
 */
class m200617_092320_rename_language_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('language','language','name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('language','name','language');
    }
}
