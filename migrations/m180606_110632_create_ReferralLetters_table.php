<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ReferralLetters`.
 */
class m180606_110632_create_ReferralLetters_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ReferralLetters', [
            'ReferralLettersID' => $this->primaryKey(),
            'ReferralLettersDate'=>$this->string(20),
            'ReferralLettersDescription'=>$this->text(),
            'LettersID_FK'=>$this->integer()->notNull(),
            'UsersID_Sender'=>$this->integer()->notNull(),
            'UsersID_Receiver'=>$this->integer()->notNull(),
            'ReferralLettersReadType'=>$this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ReferralLetters');
    }
}
