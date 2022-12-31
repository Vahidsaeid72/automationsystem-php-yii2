<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usersjob".
 *
 * @property int $UsersJobID
 * @property string $UsersJobStartDate
 * @property string $UsersJobEndDate
 * @property int $UsersJobStatus
 * @property int $UsersID_FK
 * @property int $JobsID_FK
 */
class Usersjob extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usersjob';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UsersJobStatus', 'UsersID_FK', 'JobsID_FK'], 'integer'],
            [['UsersID_FK', 'JobsID_FK'], 'required'],
            [['UsersJobStartDate', 'UsersJobEndDate'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'UsersJobID' => 'Users Job ID',
            'UsersJobStartDate' => 'تاریخ شروع',
            'UsersJobEndDate' => 'تاریخ پایان',
            'UsersJobStatus' => 'وضعیت',
            'UsersID_FK' => 'کاربران',
            'JobsID_FK' => 'نام شغل',
        ];
    }
}