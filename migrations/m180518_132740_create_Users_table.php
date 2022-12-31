<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Users`.
 */
class m180518_132740_create_Users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Users', [
            'UsersID' => $this->primaryKey(),
            'UsersName'=>$this->string(100)->notNull(),
            'UsersFamily'=>$this->string(100)->notNull(),
            'UsersUserName'=>$this->string(100)->notNull(),
            'UsersPassword'=>$this->string(50)->notNull(),
            'UsersGender'=>$this->boolean()->notNull(),
            'UsersActivity'=>$this->boolean()->notNull(),
            'UsersEmail'=>$this->string(40),
            'UsersPhone'=>$this->string(30),
            'UsersMobile'=>$this->string(30),
            'UsersPicture'=>$this->string(255)

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('Users');
    }
}
