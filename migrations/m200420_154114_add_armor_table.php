<?php

use yii\db\Migration;

/**
 * Class m200420_154114_add_armor_table
 */
class m200420_154114_add_armor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%armor}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'type' => $this->string(),
            'cost' => $this->string(),
            'weight' => $this->float(),
            'armor_class' => $this->integer()->notNull(),
            'armor_class_modifier' => $this->string(),
            'armor_class_modifier_max' => $this->integer(),
            'strength_requirement' => $this->integer(),
            'stealth_disandvantage' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->dateTime(). ' DEFAULT NOW()',
            'updated_at' => $this->dateTime(). ' DEFAULT NOW()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%armor}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200420_154114_add_armor_table cannot be reverted.\n";

        return false;
    }
    */
}
