<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_usersjob".
 *
 * @property int $UsersJobID
 * @property string $UsersJobStartDate
 * @property string $UsersJobEndDate
 * @property int $UsersJobStatus
 * @property int $UsersID_FK
 * @property int $JobsID_FK
 * @property int $JobsID
 * @property string $JobsName
 * @property string $JobsDescription
 * @property int $JobsLevel
 * @property int $JobsParentID
 * @property int $JobsStatus
 * @property string $FullName
 * @property string $PersianJobsStatus
 */
class VwUsersjob extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_usersjob';
    }
    public static function primaryKey()
    {
        return ['UsersJobID'];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UsersJobID', 'UsersJobStatus', 'UsersID_FK', 'JobsID_FK', 'JobsID', 'JobsLevel', 'JobsParentID', 'JobsStatus'], 'integer'],
            [['UsersID_FK', 'JobsID_FK', 'JobsName', 'JobsLevel', 'JobsParentID'], 'required'],
            [['UsersJobStartDate', 'UsersJobEndDate'], 'string', 'max' => 20],
            [['JobsName'], 'string', 'max' => 100],
            [['JobsDescription'], 'string', 'max' => 500],
            [['FullName'], 'string', 'max' => 201],
            [['PersianJobsStatus'], 'string', 'max' => 14],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'UsersJobID' => 'Users Job ID',
            'UsersJobStartDate' => 'تاریخ انتصاب شغل',
            'UsersJobEndDate' => 'تاریخ عزل شغل',
            'UsersJobStatus' => 'Users Job Status',
            'UsersID_FK' => 'Users Id  Fk',
            'JobsID_FK' => 'Jobs Id  Fk',
            'JobsID' => 'Jobs ID',
            'JobsName' => 'نام شغل',
            'JobsDescription' => 'Jobs Description',
            'JobsLevel' => 'Jobs Level',
            'JobsParentID' => 'Jobs Parent ID',
            'JobsStatus' => 'Jobs Status',
            'FullName' => 'نام متصدی',
            'PersianJobsStatus' => 'وضعیت شغل',
        ];
    }
}