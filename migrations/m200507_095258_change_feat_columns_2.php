<?php

use yii\db\Migration;

/**
 * Class m200507_095258_change_feat_columns_2
 */
class m200507_095258_change_feat_columns_2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('feat','counter',$this->integer());
        $this->addColumn('feat','counter_type',$this->string());
        $this->addColumn('feat','damage',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('feat','counter');
        $this->dropColumn('feat','counter_type');
        $this->dropColumn('feat','damage');
    }
}
