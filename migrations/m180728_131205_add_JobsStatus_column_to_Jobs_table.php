<?php

use yii\db\Migration;

/**
 * Handles adding JobsStatus to table `Jobs`.
 */
class m180728_131205_add_JobsStatus_column_to_Jobs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('Jobs','JobsStatus',$this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
