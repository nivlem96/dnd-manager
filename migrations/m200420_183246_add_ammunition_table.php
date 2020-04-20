<?php

use yii\db\Migration;

/**
 * Class m200420_183246_add_ammunition_table
 */
class m200420_183246_add_ammunition_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ammunition}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'type' => $this->string(),
            'cost' => $this->string(),
            'weight' => $this->float(),
            'created_at' => $this->dateTime(). ' DEFAULT NOW()',
            'updated_at' => $this->dateTime(). ' DEFAULT NOW()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ammunition}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200420_183246_add_ammunition_table cannot be reverted.\n";

        return false;
    }
    */
}
