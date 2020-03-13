<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m200313_144941_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'firstname' => $this->string(),
            'lastname' => $this->string(),
            'accessToken' => $this->string(),
            'authKey' => $this->string(),
            'rank' => $this->integer()->defaultValue(0),
            'created_at' => $this->dateTime(). ' DEFAULT NOW()',
            'updated_at' => $this->dateTime(). ' DEFAULT NOW()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
