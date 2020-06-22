<?php

use yii\db\Migration;

/**
 * Class m200622_122210_add_proficiency_trait_relation_table
 */
class m200622_122210_add_proficiency_trait_relation_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%background_traits}}', [
            'id' => $this->primaryKey(),
            'background_id' => $this->integer(),
            'trait_type' => $this->string(),
            'trait' => $this->text(),
            'created_at' => $this->dateTime() . ' DEFAULT NOW()',
            'updated_at' => $this->dateTime() . ' DEFAULT NOW()',
            'created_by_user_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-background_traits-background',
            'background_traits',
            'background_id',
            'background',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk-background_traits-background', 'background_traits');
        $this->dropTable('background_traits');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200622_122210_add_proficiency_trait_relation_table cannot be reverted.\n";

        return false;
    }
    */
}
