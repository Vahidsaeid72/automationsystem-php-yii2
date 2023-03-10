<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_letters".
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
 * @property string $fullNameCreator
 * @property string $persianLettersDraftType
 * @property string $persianLettersType
 * @property string $persianLettersTypeOfAction
 * @property string $persianLettersSecurity
 * @property string $persianLettersFollowType
 * @property string $persianLettersResponseType
 * @property string $persianLettersAttachmentType
 * @property string $persianLettersArchiveType
 */
class VwLetters extends \yii\db\ActiveRecord
{
    public static function primaryKey()
    {
        return ['LettersID'];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_letters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LettersID', 'LettersDraftType', 'LettersType', 'LettersTypeOfAction', 'LettersSecurity', 'LettersFollowType', 'LettersResponseType', 'LettersResponseID', 'LettersAttachmentType', 'LettersArchiveType', 'UsersID_FK'], 'integer'],
            [['LettersSubject'], 'required'],
            [['LettersText'], 'string'],
            [['LettersSubject'], 'string', 'max' => 400],
            [['LettersAbstract'], 'string', 'max' => 500],
            [['LettersCreateDate', 'LettersResponseDate'], 'string', 'max' => 20],
            [['LettersNumber'], 'string', 'max' => 40],
            [['LettersAttachmentUrl', 'LettersAttachmentFileName'], 'string', 'max' => 200],
            [['fullNameCreator'], 'string', 'max' => 201],
            [['persianLettersDraftType'], 'string', 'max' => 8],
            [['persianLettersType', 'persianLettersArchiveType'], 'string', 'max' => 12],
            [['persianLettersTypeOfAction'], 'string', 'max' => 4],
            [['persianLettersSecurity'], 'string', 'max' => 7],
            [['persianLettersFollowType', 'persianLettersResponseType', 'persianLettersAttachmentType'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'LettersID' => 'Letters ID',
            'LettersSubject' => '?????????? ',
            'LettersText' => '?????? ',
            'LettersAbstract' => '??????????',
            'LettersCreateDate' => '?????????? ??????',
            'LettersNumber' => '?????????? ????????',
            'LettersDraftType' => '?????????? ????????',
            'LettersType' => '?????? ????????',
            'LettersTypeOfAction' => '?????? ??????????',
            'LettersSecurity' => '????????????????',
            'LettersFollowType' => '????????????',
            'LettersResponseType' => '???????? ????????',
            'LettersResponseDate' => '?????????? ???????? ????????',
            'LettersResponseID' => 'Letters Response ID',
            'LettersAttachmentType' => '??????????',
            'LettersAttachmentUrl' => '???????? ??????????',
            'LettersAttachmentFileName' => '?????? ???????? ??????????',
            'LettersArchiveType' => '?????????????? ',
            'UsersID_FK' => 'Users Id  Fk',
            'FullNameCreator' => '?????????? ??????????',
            'persianLettersDraftType' => '??????',
            'persianLettersType' => '?????? ????????',
            'persianLettersTypeOfAction' => '?????? ??????????',
            'persianLettersSecurity' => '????????????????',
            'persianLettersFollowType' => '????????????',
            'persianLettersResponseType' => '???????? ????????',
            'persianLettersAttachmentType' => '??????????',
            'persianLettersArchiveType' => '??????????????',
        ];
    }
}