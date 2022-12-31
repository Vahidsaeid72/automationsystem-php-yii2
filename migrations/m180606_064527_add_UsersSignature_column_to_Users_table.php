<?php

use yii\db\Migration;

/**
 * Handles adding UsersSignature to table `Users`.
 */
class m180606_064527_add_UsersSignature_column_to_Users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('Users','UsersSignature',$this->string(200));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
