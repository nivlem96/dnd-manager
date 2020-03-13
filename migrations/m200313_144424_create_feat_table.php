<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feat}}`.
 */
class m200313_144424_create_feat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%feat}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'unlocked_at' => $this->integer(),
            'class_id' => $this->integer(),
            'race_id' => $this->integer(),
            'created_by_user_id' => $this->integer(),
            'created_at' => $this->dateTime(). ' DEFAULT NOW()',
            'updated_at' => $this->dateTime(). ' DEFAULT NOW()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%feat}}');
    }
}
