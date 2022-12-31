<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jobs".
 *
 * @property int $JobsID
 * @property string $JobsName
 * @property string $JobsDescription
 * @property int $JobsLevel
 * @property int $JobsParentID
 * @property int $JobsStatus
 */
class Jobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobs';
    }

    public static function primaryKey()
    {
        return ['JobsID'];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['JobsName', 'JobsLevel', 'JobsParentID'], 'required'],
            ['JobsName', 'unique'],
            ['JobsName', 'trim'],
            [['JobsLevel', 'JobsParentID', 'JobsStatus'], 'integer'],
            [['JobsName'], 'string', 'max' => 100],
            [['JobsDescription'], 'string', 'max' => 500],
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
            'JobsParentID' => 'زیر مجموعه',
            'JobsStatus' => 'Jobs Status',
        ];
    }
}