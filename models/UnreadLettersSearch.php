<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VwRecieveletter;
use yii\web\NotFoundHttpException;

/**
 * UnreadLettersSearch represents the model behind the search form of `app\models\VwRecieveletter`.
 */
class UnreadLettersSearch extends VwRecieveletter
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LettersID', 'LettersDraftType', 'LettersType', 'LettersTypeOfAction', 'LettersSecurity', 'LettersFollowType', 'LettersResponseType', 'LettersResponseID', 'LettersAttachmentType', 'LettersArchiveType', 'UsersID_FK', 'SendLettersID', 'UsersID_Reciever', 'SendLettersReadType'], 'integer'],
            [['LettersSubject', 'LettersText', 'LettersAbstract', 'LettersCreateDate', 'LettersNumber', 'LettersResponseDate', 'LettersAttachmentUrl', 'LettersAttachmentFileName', 'FullNameSender', 'FullNameReciever', 'SendLettersDate', 'PersianLettersTypeOfAction', 'PersianLettersSecurity', 'PersianLettersArchiveType', 'PersianLettersFollowType', 'PersianLettersAttachmentType', 'PersianLettersType', 'PersianLettersResponseType', 'PersianLettersDraftType', 'PersianSendLettersReadType'], 'safe'],
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
        $UserID = Yii::$app->user->id;
        if ($UserID) {
            $query = VwRecieveletter::find()->where(['UsersID_Reciever' => $UserID])->andWhere(['LettersDraftType' => 2])->andWhere(['SendLettersReadType' => 1]);
        } else {
            throw new NotFoundHttpException('خطا در UnreadLettersSearch');
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>
            [
                'pageSizeParam' => false,
                'pageSize' => 6,

            ],
            'sort' =>
            [
                'defaultOrder' =>
                [
                    'LettersID' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
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
            'SendLettersID' => $this->SendLettersID,
            'UsersID_Reciever' => $this->UsersID_Reciever,
            'SendLettersReadType' => $this->SendLettersReadType,
        ]);

        $query->andFilterWhere(['like', 'LettersSubject', $this->LettersSubject])
            ->andFilterWhere(['like', 'LettersText', $this->LettersText])
            ->andFilterWhere(['like', 'LettersAbstract', $this->LettersAbstract])
            ->andFilterWhere(['like', 'LettersCreateDate', $this->LettersCreateDate])
            ->andFilterWhere(['like', 'LettersNumber', $this->LettersNumber])
            ->andFilterWhere(['like', 'LettersResponseDate', $this->LettersResponseDate])
            ->andFilterWhere(['like', 'LettersAttachmentUrl', $this->LettersAttachmentUrl])
            ->andFilterWhere(['like', 'LettersAttachmentFileName', $this->LettersAttachmentFileName])
            ->andFilterWhere(['like', 'FullNameSender', $this->FullNameSender])
            ->andFilterWhere(['like', 'FullNameReciever', $this->FullNameReciever])
            ->andFilterWhere(['like', 'SendLettersDate', $this->SendLettersDate])
            ->andFilterWhere(['like', 'PersianLettersTypeOfAction', $this->PersianLettersTypeOfAction])
            ->andFilterWhere(['like', 'PersianLettersSecurity', $this->PersianLettersSecurity])
            ->andFilterWhere(['like', 'PersianLettersArchiveType', $this->PersianLettersArchiveType])
            ->andFilterWhere(['like', 'PersianLettersFollowType', $this->PersianLettersFollowType])
            ->andFilterWhere(['like', 'PersianLettersAttachmentType', $this->PersianLettersAttachmentType])
            ->andFilterWhere(['like', 'PersianLettersType', $this->PersianLettersType])
            ->andFilterWhere(['like', 'PersianLettersResponseType', $this->PersianLettersResponseType])
            ->andFilterWhere(['like', 'PersianLettersDraftType', $this->PersianLettersDraftType])
            ->andFilterWhere(['like', 'PersianSendLettersReadType', $this->PersianSendLettersReadType]);

        return $dataProvider;
    }
}