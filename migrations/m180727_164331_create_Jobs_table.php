<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Jobs`.
 */
class m180727_164331_create_Jobs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Jobs', [
            'JobsID' => $this->primaryKey(),
            'JobsName'=>$this->string(100)->notNull(),
            'JobsDescription'=>$this->string(500),
            'JobsLevel'=>$this->integer()->notNull(),
            'JobsParentID'=>$this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('Jobs');
    }
}
