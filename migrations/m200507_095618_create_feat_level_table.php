<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feat_level}}`.
 */
class m200507_095618_create_feat_level_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%feat_level}}', [
            'id' => $this->primaryKey(),
            'feat_id' => $this->integer(),
            'level' => $this->integer(),
            'counter' => $this->integer(),
            'damage' => $this->string(),
            'created_at' => $this->dateTime() . ' DEFAULT NOW()',
            'updated_at' => $this->dateTime() . ' DEFAULT NOW()',
        ]);
        $this->addForeignKey(
            'fk-feat_level-feat',
            'feat_level',
            'feat_id',
            'feat',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk-feat_level-feat','feat_level');
        $this->dropTable('{{%feat_level}}');
    }
}
