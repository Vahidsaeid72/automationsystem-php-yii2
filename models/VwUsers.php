<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_users".
 *
 * @property int $UsersID
 * @property string $UsersName
 * @property string $UsersFamily
 * @property string $UsersUserName
 * @property string $UsersPassword
 * @property int $UsersGender
 * @property int $UsersActivity
 * @property string $UsersEmail
 * @property string $UsersPhone
 * @property string $UsersMobile
 * @property string $UsersPicture
 * @property string $UsersSignature
 * @property string $FullName
 * @property string $PersianUsersGender
 * @property string $PersianUsersActivity
 */
class VwUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_users';
    }
    public static function primaryKey()
    {
        return ['UsersID'];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UsersID', 'UsersGender', 'UsersActivity'], 'integer'],
            [['UsersName', 'UsersFamily', 'UsersUserName', 'UsersPassword', 'UsersGender', 'UsersActivity'], 'required'],
            [['UsersName', 'UsersFamily', 'UsersUserName'], 'string', 'max' => 100],
            [['UsersPassword'], 'string', 'max' => 50],
            [['UsersEmail'], 'string', 'max' => 40],
            [['UsersPhone', 'UsersMobile'], 'string', 'max' => 30],
            [['UsersPicture'], 'string', 'max' => 255],
            [['UsersSignature'], 'string', 'max' => 200],
            [['FullName'], 'string', 'max' => 201],
            [['PersianUsersGender'], 'string', 'max' => 3],
            [['PersianUsersActivity'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'UsersID' => 'ID',
            'UsersName' => 'نام ',
            'UsersFamily' => 'نام خانوادگی',
            'UsersUserName' => 'نام کاربری',
            'ReapetedPassword' => 'تکرار رمز عبور',
            'UsersPassword' => 'رمز عبور',
            'UsersGender' => 'جنسیت',
            'UsersActivity' => 'فعال بودن',
            'UsersEmail' => 'ایمیل',
            'UsersPhone' => 'شماره تلفن',
            'UsersMobile' => 'شماره موبایل',
            'UsersPicture' => 'تصویر',
            'UsersSignature' => 'امضا',
            'FullName' => 'Full Name',
            'PersianUsersGender' => 'جنسیت',
            'PersianUsersActivity' => 'وضعیت',
        ];
    }
}