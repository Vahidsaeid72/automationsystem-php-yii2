<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VwReferralletters;
use yii\web\NotFoundHttpException;

/**
 * SendReferrallettersSearch represents the model behind the search form of `app\models\VwReferralletters`.
 */
class RotationReferrallettersSearch extends VwReferralletters
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ReferralLettersID', 'LettersID_FK', 'UsersID_Sender', 'UsersID_Receiver', 'ReferralLettersReadType', 'LettersID', 'LettersDraftType', 'LettersType', 'LettersTypeOfAction', 'LettersSecurity', 'LettersFollowType', 'LettersResponseType', 'LettersResponseID', 'LettersAttachmentType', 'LettersArchiveType', 'UsersID_FK'], 'integer'],
            [['ReferralLettersDate', 'ReferralLettersDescription', 'LettersSubject', 'LettersText', 'LettersAbstract', 'LettersCreateDate', 'LettersNumber', 'LettersResponseDate', 'LettersAttachmentUrl', 'LettersAttachmentFileName', 'FullNameSender', 'FullNameReceiver', 'FullCreator', 'PersianLettersTypeOfAction', 'PersianLettersSecurity', 'PersianLettersArchiveType', 'PersianLettersFollowType', 'PersianLettersAttachmentType', 'PersianLettersType', 'PersianLettersResponseType', 'PersianLettersDraftType', 'PersianReferralLettersReadType'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $session = Yii::$app->session;
        $LetterRotationID = $session->get('RotationLetterID');

        if (Yii::$app->user->id && $LetterRotationID) {

            $query = VwReferralletters::find()->where(['LettersID_FK' => $LetterRotationID]);
        } else {
            throw new NotFoundHttpException('خطا در RotationReferrallettersSearch');
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // 'pagination' =>
            // [
            //     'pageSizeParam' => false,
            //     'pageSize' => 6,

            // ],
            // 'sort' =>
            // [
            //     'defaultOrder' =>
            //     [
            //         'ReferralLettersID' => SORT_DESC
            //     ]
            // ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ReferralLettersID' => $this->ReferralLettersID,
            'LettersID_FK' => $this->LettersID_FK,
            'UsersID_Sender' => $this->UsersID_Sender,
            'UsersID_Receiver' => $this->UsersID_Receiver,
            'ReferralLettersReadType' => $this->ReferralLettersReadType,
            'LettersID' => $this->LettersID,
            'LettersDraftType' => $this->LettersDraftType,
            'LettersType' => $this->LettersType,
            'LettersTypeOfAction' => $this->LettersTypeOfAction,
            'LettersSecurity' => $this->LettersSecurity,
            'LettersFollowType' => $this->LettersFollowType,
            'LettersResponseType' => $this->LettersResponseType,
            'LettersResponseID' => $this->LettersResponseID,
            'LettersAttachmentType' => $this->LettersAttachmentType,
            'LettersArchiveType' => $this->LettersArchiveType,
            'UsersID_FK' => $this->UsersID_FK,
        ]);

        $query->andFilterWhere(['like', 'ReferralLettersDate', $this->ReferralLettersDate])
            ->andFilterWhere(['like', 'ReferralLettersDescription', $this->ReferralLettersDescription])
            ->andFilterWhere(['like', 'LettersSubject', $this->LettersSubject])
            ->andFilterWhere(['like', 'LettersText', $this->LettersText])
            ->andFilterWhere(['like', 'LettersAbstract', $this->LettersAbstract])
            ->andFilterWhere(['like', 'LettersCreateDate', $this->LettersCreateDate])
            ->andFilterWhere(['like', 'LettersNumber', $this->LettersNumber])
            ->andFilterWhere(['like', 'LettersResponseDate', $this->LettersResponseDate])
            ->andFilterWhere(['like', 'LettersAttachmentUrl', $this->LettersAttachmentUrl])
            ->andFilterWhere(['like', 'LettersAttachmentFileName', $this->LettersAttachmentFileName])
            ->andFilterWhere(['like', 'FullNameSender', $this->FullNameSender])
            ->andFilterWhere(['like', 'FullNameReceiver', $this->FullNameReceiver])
            ->andFilterWhere(['like', 'FullCreator', $this->FullCreator])
            ->andFilterWhere(['like', 'PersianLettersTypeOfAction', $this->PersianLettersTypeOfAction])
            ->andFilterWhere(['like', 'PersianLettersSecurity', $this->PersianLettersSecurity])
            ->andFilterWhere(['like', 'PersianLettersArchiveType', $this->PersianLettersArchiveType])
            ->andFilterWhere(['like', 'PersianLettersFollowType', $this->PersianLettersFollowType])
            ->andFilterWhere(['like', 'PersianLettersAttachmentType', $this->PersianLettersAttachmentType])
            ->andFilterWhere(['like', 'PersianLettersType', $this->PersianLettersType])
            ->andFilterWhere(['like', 'PersianLettersResponseType', $this->PersianLettersResponseType])
            ->andFilterWhere(['like', 'PersianLettersDraftType', $this->PersianLettersDraftType])
            ->andFilterWhere(['like', 'PersianReferralLettersReadType', $this->PersianReferralLettersReadType]);

        return $dataProvider;
    }
}