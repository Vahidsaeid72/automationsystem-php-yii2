<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sendletters".
 *
 * @property int $SendLettersID
 * @property int $LettersID_FK
 * @property int $UsersID_FK
 * @property string $SendLettersDate
 * @property int $SendLettersReadType
 */
class Sendletters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sendletters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LettersID_FK', 'UsersID_FK', 'SendLettersReadType'], 'integer'],
            [['LettersID_FK', 'UsersID_FK'], 'required'],
            [['SendLettersDate'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SendLettersID' => 'Send Letters ID',
            'LettersID_FK' => 'Letters Id  Fk',
            'UsersID_FK' => 'Users Id  Fk',
            'SendLettersDate' => 'Send Letters Date',
            'SendLettersReadType' => 'Send Letters Read Type',
        ];
    }
}