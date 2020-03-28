<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sub_race}}`.
 */
class m200328_144755_create_sub_race_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
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

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-sub_race-race',
            'sub_race'
        );
        $this->dropTable('{{%sub_race}}');
    }
}
