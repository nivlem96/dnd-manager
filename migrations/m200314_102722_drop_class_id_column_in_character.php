<?php

use yii\db\Migration;

/**
 * Class m200314_102722_drop_class_id_column_in_character
 */
class m200314_102722_drop_class_id_column_in_character extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-character-class','character');
        $this->dropColumn('character','class_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('character','class_id',$this->integer());
        $this->addForeignKey(
            'fk-character-class',
            'character',
            'class_id',
            'character_class',
            'id'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200314_102722_drop_class_id_column_in_character cannot be reverted.\n";

        return false;
    }
    */
}
