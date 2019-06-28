<?php

use yii\db\Migration;


class m190625_172946_alter_user_table extends Migration
{


    public function safeUp()
    {
        $this->addColumn('{{%user}}','about',$this->string());
        $this->addColumn('{{%user}}','nickname',$this->string(70));
        $this->addColumn('{{%user}}','picture',$this->string());
        $this->addColumn('{{%user}}','weight',$this->integer(3));
        $this->addColumn('{{%user}}','height',$this->integer(3));
        $this->addColumn('{{%user}}','calorie',$this->integer(5)->defaultValue(0));
        $this->addColumn('{{%user}}','protein',$this->integer(4)->defaultValue(0));
        $this->addColumn('{{%user}}','carbohydrates',$this->integer(4)->defaultValue(0));
        $this->addColumn('{{%user}}','fat',$this->integer(4)->defaultValue(0));
        $this->addColumn('{{%user}}','train_program_id',$this->integer());

    }


    public function Down()
    {
        $this->dropColumn('{{%user}}','about');
        $this->dropColumn('{{%user}}','nickname');
        $this->dropColumn('{{%user}}','picture');
        $this->dropColumn('{{%user}}','weight');
        $this->dropColumn('{{%user}}','height');
        $this->dropColumn('{{%user}}','calorie');
        $this->dropColumn('{{%user}}','protein');
        $this->dropColumn('{{%user}}','carbohydrates');
        $this->dropColumn('{{%user}}','fat');
        $this->dropColumn('{{%user}}','train_program_id');
    }


}
