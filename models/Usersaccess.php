<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usersaccess".
 *
 * @property int $UsersAccessID
 * @property int $UsersAccess1
 * @property int $UsersAccess2
 * @property int $UsersAccess3
 * @property int $UsersAccess4
 * @property int $UsersAccess5
 * @property int $UsersAccess6
 * @property int $UsersAccess7
 * @property int $UsersAccess8
 * @property int $UsersAccess9
 * @property int $UsersAccess10
 * @property int $UsersAccess11
 * @property int $UsersAccess12
 * @property int $UsersAccess13
 * @property int $UsersAccess14
 * @property int $UsersAccess15
 * @property int $UsersAccess16
 * @property int $UsersAccess17
 * @property int $UsersAccess18
 * @property int $UsersAccess19
 * @property int $UsersAccess20
 * @property int $UsersAccess21
 * @property int $UsersAccess22
 * @property int $UsersAccess23
 * @property int $UsersAccess24
 * @property int $UsersAccess25
 * @property int $UsersID_FK
 */
class Usersaccess extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usersaccess';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UsersAccess1', 'UsersAccess2', 'UsersAccess3', 'UsersAccess4', 'UsersAccess5', 'UsersAccess6', 'UsersAccess7', 'UsersAccess8', 'UsersAccess9', 'UsersAccess10', 'UsersAccess11', 'UsersAccess12', 'UsersAccess13', 'UsersAccess14', 'UsersAccess15', 'UsersAccess16', 'UsersAccess17', 'UsersAccess18', 'UsersAccess19', 'UsersAccess20', 'UsersAccess21', 'UsersAccess22', 'UsersAccess23', 'UsersAccess24', 'UsersAccess25', 'UsersID_FK'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'UsersAccessID' => 'Users Access ID',
            'UsersAccess1' => 'ثبت پیشنویس',
            'UsersAccess2' => 'صندوق ورودی',
            'UsersAccess3' => 'نامه های خوانده شده',
            'UsersAccess4' => 'نامه های خوانده نشده',
            'UsersAccess5' => 'نامه های محرمانه',
            'UsersAccess6' => 'نامه های اقدام فوری',
            'UsersAccess7' => 'صندوق خروجی',
            'UsersAccess8' => 'ارجاعی رسیده',
            'UsersAccess9' => 'ارجاعی ارسالی',
            'UsersAccess10' => 'نامه های پیگیری دار',
            'UsersAccess11' => 'کاربران',
            'UsersAccess12' => 'مدیریت مشاغل',
            'UsersAccess13' => 'سطل زباله',
            'UsersAccess14' => 'مدیریت سطوح دسترسی',
            'UsersAccess15' => 'Users Access15',
            'UsersAccess16' => 'Users Access16',
            'UsersAccess17' => 'Users Access17',
            'UsersAccess18' => 'Users Access18',
            'UsersAccess19' => 'Users Access19',
            'UsersAccess20' => 'Users Access20',
            'UsersAccess21' => 'Users Access21',
            'UsersAccess22' => 'Users Access22',
            'UsersAccess23' => 'Users Access23',
            'UsersAccess24' => 'Users Access24',
            'UsersAccess25' => 'Users Access25',
            'UsersID_FK' => 'کاربران',
        ];
    }
}