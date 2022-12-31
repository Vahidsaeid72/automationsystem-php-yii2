<?php

use yii\db\Migration;

/**
 * Handles the creation of table `UsersJob`.
 */
class m180728_130301_create_UsersJob_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('UsersJob', [
            'UsersJobID' => $this->primaryKey(),
            'UsersJobStartDate'=>$this->string(20),
            'UsersJobEndDate'=>$this->string(20),
            'UsersJobStatus'=>$this->boolean(),
            'UsersID_FK'=>$this->integer(),
            'JobsID_FK'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('UsersJob');
    }
}
