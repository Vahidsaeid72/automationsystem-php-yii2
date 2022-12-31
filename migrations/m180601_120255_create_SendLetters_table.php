<?php

use yii\db\Migration;

/**
 * Handles the creation of table `SendLetters`.
 */
class m180601_120255_create_SendLetters_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('SendLetters', [
            'SendLettersID' => $this->primaryKey(),
            'LettersID_FK'=>$this->integer(),
            'UsersID_FK'=>$this->integer(),
            'SendLettersDate'=>$this->string(20),
            'SendLettersReadType'=>$this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('SendLetters');
    }
}
