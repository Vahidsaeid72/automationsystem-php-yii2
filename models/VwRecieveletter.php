<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_recieveletter".
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
 * @property string $FullNameSender
 * @property string $FullNameReciever
 * @property int $SendLettersID
 * @property int $UsersID_Reciever
 * @property string $SendLettersDate
 * @property int $SendLettersReadType
 * @property string $PersianLettersTypeOfAction
 * @property string $PersianLettersSecurity
 * @property string $PersianLettersArchiveType
 * @property string $PersianLettersFollowType
 * @property string $PersianLettersAttachmentType
 * @property string $PersianLettersType
 * @property string $PersianLettersResponseType
 * @property string $PersianLettersDraftType
 * @property string $PersianSendLettersReadType
 */
class VwRecieveletter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_recieveletter';
    }
    public static function primaryKey()
    {
        return ['LettersID'];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LettersID', 'LettersDraftType', 'LettersType', 'LettersTypeOfAction', 'LettersSecurity', 'LettersFollowType', 'LettersResponseType', 'LettersResponseID', 'LettersAttachmentType', 'LettersArchiveType', 'UsersID_FK', 'SendLettersID', 'UsersID_Reciever', 'SendLettersReadType'], 'integer'],
            [['LettersSubject'], 'required'],
            [['LettersText'], 'string'],
            [['LettersSubject'], 'string', 'max' => 400],
            [['LettersAbstract'], 'string', 'max' => 500],
            [['LettersCreateDate', 'LettersResponseDate', 'SendLettersDate'], 'string', 'max' => 20],
            [['LettersNumber'], 'string', 'max' => 40],
            [['LettersAttachmentUrl', 'LettersAttachmentFileName'], 'string', 'max' => 200],
            [['FullNameSender', 'FullNameReciever'], 'string', 'max' => 201],
            [['PersianLettersTypeOfAction'], 'string', 'max' => 4],
            [['PersianLettersSecurity', 'PersianLettersDraftType'], 'string', 'max' => 7],
            [['PersianLettersArchiveType', 'PersianLettersFollowType', 'PersianLettersType'], 'string', 'max' => 12],
            [['PersianLettersAttachmentType', 'PersianSendLettersReadType'], 'string', 'max' => 11],
            [['PersianLettersResponseType'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'LettersID' => 'Letters ID',
            'LettersSubject' => 'موضوع',
            'LettersText' => 'Letters Text',
            'LettersAbstract' => 'چکیده',
            'LettersCreateDate' => 'Letters Create Date',
            'LettersNumber' => 'شماره نامه',
            'LettersDraftType' => 'Letters Draft Type',
            'LettersType' => 'Letters Type',
            'LettersTypeOfAction' => 'Letters Type Of Action',
            'LettersSecurity' => 'Letters Security',
            'LettersFollowType' => 'Letters Follow Type',
            'LettersResponseType' => 'Letters Response Type',
            'LettersResponseDate' => 'تاریخ مهلت پاسخ',
            'LettersResponseID' => 'Letters Response ID',
            'LettersAttachmentType' => 'Letters Attachment Type',
            'LettersAttachmentUrl' => 'Letters Attachment Url',
            'LettersAttachmentFileName' => 'فایل پیوست',
            'LettersArchiveType' => 'Letters Archive Type',
            'UsersID_FK' => 'Users Id  Fk',
            'FullNameSender' => 'فرستنده',
            'FullNameReciever' => 'گیرنده',
            'SendLettersID' => 'Send Letters ID',
            'UsersID_Reciever' => 'Users Id  Reciever',
            'SendLettersDate' => 'تاریخ ارسال',
            'SendLettersReadType' => 'Send Letters Read Type',
            'PersianLettersTypeOfAction' => 'نوع اقدام',
            'PersianLettersSecurity' => 'محرمانگی',
            'PersianLettersArchiveType' => 'بایگانی',
            'PersianLettersFollowType' => 'پیگیری',
            'PersianLettersAttachmentType' => 'پیوست',
            'PersianLettersType' => 'نوع',
            'PersianLettersResponseType' => 'مهلت پاسخ',
            'PersianLettersDraftType' => 'Persian Letters Draft Type',
            'PersianSendLettersReadType' => 'وضعیت',
        ];
    }
}