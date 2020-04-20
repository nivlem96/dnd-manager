<?php

use yii\db\Migration;

/**
 * Class m200420_154057_add_weapon_table
 */
class m200420_154057_add_weapon_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%weapon}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'type' => $this->string(),
            'cost' => $this->string(),
            'weight' => $this->float(),
            'damage_die' => $this->string()->notNull()->defaultValue('1d4'),
            'damage_type' => $this->string(),
            'properties' => $this->string(255),
            'created_at' => $this->dateTime(). ' DEFAULT NOW()',
            'updated_at' => $this->dateTime(). ' DEFAULT NOW()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%weapon}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200420_154057_add_weapon_table cannot be reverted.\n";

        return false;
    }
    */
}
