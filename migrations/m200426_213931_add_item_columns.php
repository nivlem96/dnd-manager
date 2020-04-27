<?php

use yii\db\Migration;

/**
 * Class m200426_213931_add_item_columns
 */
class m200426_213931_add_item_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('item','proficiency_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('item','proficiency_id');
    }
}
