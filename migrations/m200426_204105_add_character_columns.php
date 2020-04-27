<?php

use yii\db\Migration;

/**
 * Class m200426_204105_add_character_columns
 */
class m200426_204105_add_character_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('character','proficiency',$this->integer()->notNull()->defaultValue(2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('character','proficiency');
    }
}
