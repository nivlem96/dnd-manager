<?php

use yii\db\Migration;

/**
 * Class m200427_200518_add_foreign_keys
 */
class m200427_200518_add_foreign_keys extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addForeignKey(
            'fk-default_languages-language',
            'default_languages',
            'language_id',
            'language',
            'id'
        );
        $this->addForeignKey(
            'fk-default_languages-background',
            'default_languages',
            'background_id',
            'background',
            'id'
        );
        $this->addForeignKey(
            'fk-language_relation-language',
            'language_relation',
            'language_id',
            'language',
            'id'
        );
        $this->addForeignKey(
            'fk-language_relation-character',
            'language_relation',
            'character_id',
            'character',
            'id'
        );
        $this->addForeignKey(
            'fk-default_skill-skill',
            'default_skill',
            'skill_id',
            'skill',
            'id'
        );
        $this->addForeignKey(
            'fk-default_skill-race',
            'default_skill',
            'race_id',
            'race',
            'id'
        );
        $this->addForeignKey(
            'fk-default_skill-class',
            'default_skill',
            'class_id',
            'character_class',
            'id'
        );
        $this->addForeignKey(
            'fk-default_skill-background',
            'default_skill',
            'background_id',
            'background',
            'id'
        );
        $this->addForeignKey(
            'fk-skill_relation-skill',
            'skill_relation',
            'skill_id',
            'skill',
            'id'
        );
        $this->addForeignKey(
            'fk-skill_relation-character',
            'skill_relation',
            'character_id',
            'character',
            'id'
        );
        $this->addForeignKey(
            'fk-spell_slot-class',
            'spell_slot',
            'class_id',
            'character_class',
            'id'
        );
        $this->addForeignKey(
            'fk-character_class-character_class',
            'character_class',
            'parent_id',
            'character_class',
            'id'
        );
        $this->addForeignKey(
            'fk-proficiency_relation-proficiency',
            'proficiency_relation',
            'proficiency_id',
            'proficiency',
            'id'
        );
        $this->addForeignKey(
            'fk-proficiency_relation-race',
            'proficiency_relation',
            'race_id',
            'race',
            'id'
        );
        $this->addForeignKey(
            'fk-proficiency_relation-class',
            'proficiency_relation',
            'class_id',
            'character_class',
            'id'
        );
        $this->addForeignKey(
            'fk-proficiency_relation-background',
            'proficiency_relation',
            'background_id',
            'background',
            'id'
        );
        $this->addForeignKey(
            'fk-character_proficiency_relation-character',
            'character_proficiency_relation',
            'character_id',
            'character',
            'id'
        );
        $this->addForeignKey(
            'fk-character_proficiency_relation-proficiency',
            'character_proficiency_relation',
            'proficiency_id',
            'proficiency',
            'id'
        );
        $this->addForeignKey(
            'fk-armor-proficiency',
            'armor',
            'proficiency_id',
            'proficiency',
            'id'
        );
        $this->addForeignKey(
            'fk-weapon-proficiency',
            'weapon',
            'proficiency_id',
            'proficiency',
            'id'
        );
        $this->addForeignKey(
            'fk-item-proficiency',
            'item',
            'proficiency_id',
            'proficiency',
            'id'
        );
        $this->addForeignKey(
            'fk-choice-class',
            'choice',
            'class_id',
            'character_class',
            'id'
        );
        $this->addForeignKey(
            'fk-choice_option-choice',
            'choice_option',
            'choice_id',
            'choice',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk-default_languages-language', 'default_languages');
        $this->dropForeignKey('fk-default_languages-background', 'default_languages');
        $this->dropForeignKey('fk-language_relation-language', 'language_relation');
        $this->dropForeignKey('fk-language_relation-character', 'language_relation');
        $this->dropForeignKey('fk-default_skill-skill', 'default_skill');
        $this->dropForeignKey('fk-default_skill-race', 'default_skill');
        $this->dropForeignKey('fk-default_skill-class', 'default_skill');
        $this->dropForeignKey('fk-default_skill-background', 'default_skill');
        $this->dropForeignKey('fk-skill_relation-skill', 'skill_relation');
        $this->dropForeignKey('fk-skill_relation-character', 'skill_relation');
        $this->dropForeignKey('fk-spell_slot-class', 'spell_slot');
        $this->dropForeignKey('fk-character_class-character_class', 'character_class');
        $this->dropForeignKey('fk-proficiency_relation-proficiency', 'proficiency_relation');
        $this->dropForeignKey('fk-proficiency_relation-race', 'proficiency_relation');
        $this->dropForeignKey('fk-proficiency_relation-class', 'proficiency_relation');
        $this->dropForeignKey('fk-proficiency_relation-background', 'proficiency_relation');
        $this->dropForeignKey('fk-character_proficiency_relation-character', 'character_proficiency_relation');
        $this->dropForeignKey('fk-character_proficiency_relation-proficiency', 'character_proficiency_relation');
        $this->dropForeignKey('fk-armor-proficiency', 'armor');
        $this->dropForeignKey('fk-weapon-proficiency', 'weapon');
        $this->dropForeignKey('fk-item-proficiency', 'item');
        $this->dropForeignKey('fk-choice-class', 'choice');
        $this->dropForeignKey('fk-choice_option-choice', 'choice_option');
    }
}
