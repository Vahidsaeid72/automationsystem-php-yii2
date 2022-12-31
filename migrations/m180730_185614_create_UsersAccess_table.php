<?php

use yii\db\Migration;

/**
 * Handles the creation of table `UsersAccess`.
 */
class m180730_185614_create_UsersAccess_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('UsersAccess', [
            'UsersAccessID' => $this->primaryKey(),
            'UsersAccess1'=>$this->boolean(),
            'UsersAccess2'=>$this->boolean(),
            'UsersAccess3'=>$this->boolean(),
            'UsersAccess4'=>$this->boolean(),
            'UsersAccess5'=>$this->boolean(),
            'UsersAccess6'=>$this->boolean(),
            'UsersAccess7'=>$this->boolean(),
            'UsersAccess8'=>$this->boolean(),
            'UsersAccess9'=>$this->boolean(),
            'UsersAccess10'=>$this->boolean(),
            'UsersAccess11'=>$this->boolean(),
            'UsersAccess12'=>$this->boolean(),
            'UsersAccess13'=>$this->boolean(),
            'UsersAccess14'=>$this->boolean(),
            'UsersAccess15'=>$this->boolean(),
            'UsersAccess16'=>$this->boolean(),
            'UsersAccess17'=>$this->boolean(),
            'UsersAccess18'=>$this->boolean(),
            'UsersAccess19'=>$this->boolean(),
            'UsersAccess20'=>$this->boolean(),
            'UsersAccess21'=>$this->boolean(),
            'UsersAccess22'=>$this->boolean(),
            'UsersAccess23'=>$this->boolean(),
            'UsersAccess24'=>$this->boolean(),
            'UsersAccess25'=>$this->boolean(),
            'UsersID_FK'=>$this->integer()

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('UsersAccess');
    }
}
