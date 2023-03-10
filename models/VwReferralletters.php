<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_referralletters".
 *
 * @property int $ReferralLettersID
 * @property string $ReferralLettersDate
 * @property string $ReferralLettersDescription
 * @property int $LettersID_FK
 * @property int $UsersID_Sender
 * @property int $UsersID_Receiver
 * @property int $ReferralLettersReadType
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
 * @property string $FullNameReceiver
 * @property string $FullCreator
 * @property string $PersianLettersTypeOfAction
 * @property string $PersianLettersSecurity
 * @property string $PersianLettersArchiveType
 * @property string $PersianLettersFollowType
 * @property string $PersianLettersAttachmentType
 * @property string $PersianLettersType
 * @property string $PersianLettersResponseType
 * @property string $PersianLettersDraftType
 * @property string $PersianReferralLettersReadType
 */
class VwReferralletters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_referralletters';
    }

    public static function primaryKey()
    {
        return ['ReferralLettersID'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ReferralLettersID', 'LettersID_FK', 'UsersID_Sender', 'UsersID_Receiver', 'ReferralLettersReadType', 'LettersID', 'LettersDraftType', 'LettersType', 'LettersTypeOfAction', 'LettersSecurity', 'LettersFollowType', 'LettersResponseType', 'LettersResponseID', 'LettersAttachmentType', 'LettersArchiveType', 'UsersID_FK'], 'integer'],
            [['ReferralLettersDescription', 'LettersText'], 'string'],
            [['LettersID_FK', 'UsersID_Sender', 'UsersID_Receiver', 'LettersSubject'], 'required'],
            [['ReferralLettersDate', 'LettersCreateDate', 'LettersResponseDate'], 'string', 'max' => 20],
            [['LettersSubject'], 'string', 'max' => 400],
            [['LettersAbstract'], 'string', 'max' => 500],
            [['LettersNumber'], 'string', 'max' => 40],
            [['LettersAttachmentUrl', 'LettersAttachmentFileName'], 'string', 'max' => 200],
            [['FullNameSender', 'FullNameReceiver', 'FullCreator'], 'string', 'max' => 201],
            [['PersianLettersTypeOfAction'], 'string', 'max' => 4],
            [['PersianLettersSecurity', 'PersianLettersDraftType'], 'string', 'max' => 7],
            [['PersianLettersArchiveType', 'PersianLettersFollowType', 'PersianLettersType'], 'string', 'max' => 12],
            [['PersianLettersAttachmentType', 'PersianReferralLettersReadType'], 'string', 'max' => 11],
            [['PersianLettersResponseType'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ReferralLettersID' => 'Referral Letters ID',
            'ReferralLettersDate' => '?????????? ??????????',
            'ReferralLettersDescription' => 'Referral Letters Description',
            'LettersID_FK' => 'Letters Id  Fk',
            'UsersID_Sender' => 'Users Id  Sender',
            'UsersID_Receiver' => 'Users Id  Receiver',
            'ReferralLettersReadType' => 'Referral Letters Read Type',
            'LettersID' => 'Letters ID',
            'LettersSubject' => '??????????',
            'LettersText' => 'Letters Text',
            'LettersAbstract' => '??????????',
            'LettersCreateDate' => '?????????? ??????????',
            'LettersNumber' => '?????????? ????????',
            'LettersDraftType' => 'Letters Draft Type',
            'LettersType' => 'Letters Type',
            'LettersTypeOfAction' => '?????? ??????????',
            'LettersSecurity' => '????????????????',
            'LettersFollowType' => '????????????',
            'LettersResponseType' => '???????? ????????',
            'LettersResponseDate' => '?????????? ???????? ????????',
            'LettersResponseID' => 'Letters Response ID',
            'LettersAttachmentType' => 'Letters Attachment Type',
            'LettersAttachmentUrl' => 'Letters Attachment Url',
            'LettersAttachmentFileName' => '?????? ???????? ??????????',
            'LettersArchiveType' => 'Letters Archive Type',
            'UsersID_FK' => 'Users Id  Fk',
            'FullNameSender' => '?????????? ??????????',
            'FullNameReceiver' => '????????????',
            'FullCreator' => '?????????? ??????????',
            'PersianLettersTypeOfAction' => '?????? ??????????',
            'PersianLettersSecurity' => '????????????????',
            'PersianLettersArchiveType' => '??????????????',
            'PersianLettersFollowType' => '????????????',
            'PersianLettersAttachmentType' => '??????????',
            'PersianLettersType' => '?????? ????????',
            'PersianLettersResponseType' => '???????? ????????',
            'PersianLettersDraftType' => '??????',
            'PersianReferralLettersReadType' => '??????????',
        ];
    }
}