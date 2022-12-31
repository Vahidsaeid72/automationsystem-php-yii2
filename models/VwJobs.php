<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_jobs".
 *
 * @property int $JobsID
 * @property string $JobsName
 * @property string $JobsDescription
 * @property int $JobsLevel
 * @property int $JobsParentID
 * @property int $JobsStatus
 * @property string $SubJobs
 * @property string $PersianJobsStatus
 */
class VwJobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $Username;
    public static function tableName()
    {
        return 'vw_jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['JobsID', 'JobsLevel', 'JobsParentID', 'JobsStatus'], 'integer'],
            [['JobsName', 'JobsLevel', 'JobsParentID'], 'required'],
            [['JobsName', 'SubJobs'], 'string', 'max' => 100],
            [['JobsDescription'], 'string', 'max' => 500],
            [['PersianJobsStatus', 'Username'], 'string', 'max' => 14],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'JobsID' => 'Jobs ID',
            'JobsName' => 'نام شغل',
            'JobsDescription' => 'توضیحات',
            'JobsLevel' => 'سطح',
            'JobsParentID' => 'شغل والد',
            'JobsStatus' => 'وضعیت',
            'SubJobs' => 'زیر مجموعه',
            'PersianJobsStatus' => 'وضعیت',
            'Username' => 'متصدی شغل'
        ];
    }
}