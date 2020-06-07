<?php

use yii\db\Migration;

/**
 * Class m200606_201918_add_choice_type
 */
class m200606_201918_add_choice_type extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('choice', 'choice_type', $this->string());
        $this->addColumn('choice', 'created_by_user_id', $this->integer());
        $this->addForeignKey(
            'fk-choice-user',
            'choice',
            'created_by_user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey(' choice', 'fk-choice-user');
        $this->dropColumn('choice', 'choice_type');
        $this->dropColumn('choice', 'created_by_user_id');
    }
}
