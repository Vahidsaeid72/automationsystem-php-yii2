<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "letters".
 *
 * @property int $LettersID
 * @property string $LettersSubject
 * @property string $LettersText
 * @property string $LettersAbstract
 * @property string $LettersCreateDate
 * @property string $LettersNumber
 * @property int $LettersDraftType
 * @property int $LettersType
 * @property int $LettersTypeOfAction
 * @property int $LettersSecurity
 * @property int $LettersFollowType
 * @property int $LettersResponseType
 * @property string $LettersResponseDate
 * @property int $LettersResponseID
 * @property int $LettersAttachmentType
 * @property string $LettersAttachmentUrl
 * @property string $LettersAttachmentFileName
 * @property int $LettersArchiveType
 * @property int $UsersID_FK
 * @property int $imageFile
 */
class Letters extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'letters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LettersSubject'], 'required'],
            [['LettersText'], 'string'],
            [['LettersDraftType', 'LettersType', 'LettersTypeOfAction', 'LettersSecurity', 'LettersFollowType', 'LettersResponseType', 'LettersResponseID', 'LettersAttachmentType', 'LettersArchiveType', 'UsersID_FK'], 'integer'],
            [['LettersSubject'], 'string', 'max' => 400],
            [['LettersAbstract'], 'string', 'max' => 500],
            [['LettersCreateDate', 'LettersResponseDate'], 'string', 'max' => 20],
            [['LettersNumber'], 'string', 'max' => 40],
            [['LettersAttachmentUrl', 'LettersAttachmentFileName'], 'string', 'max' => 200],
            [['LettersNumber'], 'unique'],
            ['LettersResponseDate', 'trim'],
            [['LettersTypeOfAction', 'LettersFollowType', 'LettersResponseType', 'LettersSecurity'], 'required', 'message' => 'مورد خواسته شده را تعیین کنید'],
            ['LettersResponseType', 'check_date'],
            ['imageFile', 'file']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'LettersID' => 'Letters ID',
            'LettersSubject' => 'موضوع ',
            'LettersText' => 'متن ',
            'LettersAbstract' => 'چکیده',
            'LettersCreateDate' => 'تاریخ ثبت',
            'LettersNumber' => 'شماره نامه',
            'LettersDraftType' => 'وضعیت نامه',
            'LettersType' => 'نوع نامه',
            'LettersTypeOfAction' => 'نوع اقدام',
            'LettersSecurity' => 'محرمانگی',
            'LettersFollowType' => 'پیگیری',
            'LettersResponseType' => 'مهلت پاسخ',
            'LettersResponseDate' => 'تاریخ مهلت پاسخ',
            'LettersResponseID' => 'Letters Response ID',
            'LettersAttachmentType' => 'پسوست',
            'LettersAttachmentUrl' => 'ادرس پیوست',
            'LettersAttachmentFileName' => 'نام فایل پیوست',
            'LettersArchiveType' => 'بایگانی ',
            'UsersID_FK' => 'Users Id  Fk',
            'imageFile' => 'پیوست',
        ];
    }

    public function check_date($attribute, $params, $validtion)
    {
        if ($this->LettersResponseType == 1 && trim($this->LettersResponseDate) == '') {
            return $this->addError($attribute, 'تاریخ مهلت پاسخ را تعیین کنید');
        } else if ($this->LettersResponseType == 2 && trim($this->LettersResponseDate) != '') {
            return $this->addError($attribute, 'تاریخ مهلت پاسخ را خالی کنید');
        }
    }
}