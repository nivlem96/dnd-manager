<?php

use yii\db\Migration;

/**
 * Class m200429_180908_add_created_by_user_id_columns_and_foreign_keys
 */
class m200429_180908_add_created_by_user_id_columns_and_foreign_keys extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('background', 'created_by_user_id', $this->integer());
        $this->addForeignKey(
            'fk-background-user',
            'background',
            'created_by_user_id',
            'user',
            'id'
        );
        $this->addColumn('encounter', 'created_by_user_id', $this->integer());
        $this->addForeignKey(
            'fk-encounter-user',
            'encounter',
            'created_by_user_id',
            'user',
            'id'
        );
        $this->addColumn('enemy', 'created_by_user_id', $this->integer());
        $this->addForeignKey(
            'fk-enemy-user',
            'enemy',
            'created_by_user_id',
            'user',
            'id'
        );
        $this->addColumn('event', 'created_by_user_id', $this->integer());
        $this->addForeignKey(
            'fk-event-user',
            'event',
            'created_by_user_id',
            'user',
            'id'
        );
        $this->addColumn('language', 'created_by_user_id', $this->integer());
        $this->addForeignKey(
            'fk-language-user',
            'language',
            'created_by_user_id',
            'user',
            'id'
        );
        $this->addColumn('npc', 'created_by_user_id', $this->integer());
        $this->addForeignKey(
            'fk-npc-user',
            'npc',
            'created_by_user_id',
            'user',
            'id'
        );
        $this->addColumn('proficiency', 'created_by_user_id', $this->integer());
        $this->addForeignKey(
            'fk-proficiency-user',
            'proficiency',
            'created_by_user_id',
            'user',
            'id'
        );
        $this->addColumn('skill', 'created_by_user_id', $this->integer());
        $this->addForeignKey(
            'fk-skill-user',
            'skill',
            'created_by_user_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk-background-user', 'background');
        $this->dropColumn('background', 'created_by_user_id');
        $this->dropForeignKey('fk-encounter-user', 'encounter');
        $this->dropColumn('encounter', 'created_by_user_id');
        $this->dropForeignKey('fk-enemy-user', 'enemy');
        $this->dropColumn('enemy', 'created_by_user_id');
        $this->dropForeignKey('fk-event-user', 'event');
        $this->dropColumn('event', 'created_by_user_id');
        $this->dropForeignKey('fk-language-user', 'language');
        $this->dropColumn('language', 'created_by_user_id');
        $this->dropForeignKey('fk-npc-user', 'npc');
        $this->dropColumn('npc', 'created_by_user_id');
        $this->dropForeignKey('fk-proficiency-user', 'proficiency');
        $this->dropColumn('proficiency', 'created_by_user_id');
        $this->dropForeignKey('fk-skill-user', 'skill');
        $this->dropColumn('skill', 'created_by_user_id');
    }
}
