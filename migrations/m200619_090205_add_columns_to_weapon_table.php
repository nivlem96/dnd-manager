<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%weapon}}`.
 */
class m200619_090205_add_columns_to_weapon_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('weapon', 'bonus', $this->integer());
        $this->addColumn('weapon', 'damage_die_amount', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn('weapon', 'bonus');
        $this->dropColumn('weapon', 'damage_die_amount');
    }
}
