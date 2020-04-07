<?php

use yii\db\Migration;

/**
 * Class m200407_173622_delete_sub_race_table
 */
class m200407_173622_delete_sub_race_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey(
            'fk-sub_race-race',
            'sub_race'
        );
        $this->dropTable('{{%sub_race}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%sub_race}}', [
            'id' => $this->primaryKey(),
            'race_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'created_by_user_id' => $this->integer(),
            'created_at' => $this->dateTime(). ' DEFAULT NOW()',
            'updated_at' => $this->dateTime(). ' DEFAULT NOW()',
        ]);
        $this->addForeignKey(
            'fk-sub_race-race',
            'sub_race',
            'race_id',
            'race',
            'id',
            'CASCADE'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200407_173622_delete_sub_race_table cannot be reverted.\n";

        return false;
    }
    */
}
