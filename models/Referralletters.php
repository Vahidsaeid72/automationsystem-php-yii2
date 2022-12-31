<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referralletters".
 *
 * @property int $ReferralLettersID
 * @property string $ReferralLettersDate
 * @property string $ReferralLettersDescription
 * @property int $LettersID_FK
 * @property int $UsersID_Sender
 * @property int $UsersID_Receiver
 * @property int $ReferralLettersReadType
 */
class Referralletters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referralletters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ReferralLettersDescription'], 'string'],
            [['LettersID_FK', 'UsersID_Sender', 'UsersID_Receiver'], 'required'],
            [['LettersID_FK', 'UsersID_Sender', 'UsersID_Receiver', 'ReferralLettersReadType'], 'integer'],
            [['ReferralLettersDate'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ReferralLettersID' => 'Referral Letters ID',
            'ReferralLettersDate' => 'Referral Letters Date',
            'ReferralLettersDescription' => 'Referral Letters Description',
            'LettersID_FK' => 'Letters Id  Fk',
            'UsersID_Sender' => 'Users Id  Sender',
            'UsersID_Receiver' => 'گرندگان ارجاع',
            'ReferralLettersReadType' => 'Referral Letters Read Type',
        ];
    }
}