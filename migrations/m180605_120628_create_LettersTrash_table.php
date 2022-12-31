<?php

use yii\db\Migration;

/**
 * Handles the creation of table `LettersTrash`.
 */
class m180605_120628_create_LettersTrash_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('LettersTrash', [
            'LettersTrashID' => $this->primaryKey(),
            'LettersID_FK'=>$this->integer(),
            'UsersID_FK'=>$this->integer(),
            'LettersTrashDate'=>$this->string(20)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('LettersTrash');
    }
}
