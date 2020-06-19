<?php

use yii\db\Migration;

/**
 * Class m200618_143150_rename_damage_column
 */
class m200618_143150_rename_damage_column extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->renameColumn('feat_level', 'damage', 'die_number');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->renameColumn('feat_level', 'die_number', 'damage');
    }
}
