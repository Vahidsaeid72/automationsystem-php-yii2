<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Letters`.
 */
class m180523_131231_create_Letters_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Letters', [
            'LettersID' => $this->primaryKey(),
            'LettersSubject'=>$this->string(400)->notNull(),
            'LettersText'=>$this->text(),
            'LettersAbstract'=>$this->string(500),
            'LettersCreateDate'=>$this->string(20),
            'LettersNumber'=>$this->string(40),
            'LettersDraftType'=>$this->boolean(),
            'LettersType'=>$this->boolean(),
            'LettersTypeOfAction'=>$this->boolean(),
            'LettersSecurity'=>$this->boolean(),
            'LettersFollowType'=>$this->boolean(),
            'LettersResponseType'=>$this->boolean(),
            'LettersResponseDate'=>$this->string(20),
            'LettersResponseID'=>$this->integer(),
            'LettersAttachmentType'=>$this->boolean(),
            'LettersAttachmentUrl'=>$this->string(200),
            'LettersAttachmentFileName'=>$this->string(200),
            'LettersArchiveType'=>$this->boolean(),
            'UsersID_FK'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('Letters');
    }
}
