<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
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
 */
class UsersForImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $imageFile;
    public $ReapetedPassword;
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageFile'], 'required'],
            // [['UsersGender', 'UsersActivity', 'UsersID'], 'integer'],
            // [['UsersName', 'UsersFamily', 'UsersUserName'], 'string', 'max' => 100],
            // [['UsersPassword'], 'string', 'max' => 50],
            // [['UsersEmail'], 'string', 'max' => 40],
            // [['UsersPhone', 'UsersMobile'], 'string', 'max' => 30],
            // [['UsersPicture'], 'string', 'max' => 255],
            [['UsersSignature'], 'string', 'max' => 200],
            // [['UsersEmail'], 'email'],
            // [['UsersUserName'], 'unique'],
            // [['UsersUserName'], 'trim'],
            // ['ReapetedPassword', 'compare', 'compareAttribute' => 'UsersPassword']
            ['imageFile', 'file', 'extensions' => ['jpg', 'png', 'jpeg']]
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
            'imageFile' => 'تصویر امضا'
        ];
    }
}