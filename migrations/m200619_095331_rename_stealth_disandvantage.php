<?php

use yii\db\Migration;

/**
 * Class m200619_095331_rename_stealth_disandvantage
 */
class m200619_095331_rename_stealth_disandvantage extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->renameColumn('armor', 'stealth_disandvantage', 'stealth_disadvantage');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->renameColumn('armor', 'stealth_disadvantage', 'stealth_disandvantage');
    }
}
