<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VwLetters;
use yii\web\NotFoundHttpException;

/**
 * VwLettersSearch represents the model behind the search form of `app\models\VwLetters`.
 */
class VwLettersSearch extends VwLetters
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LettersID', 'LettersDraftType', 'LettersType', 'LettersTypeOfAction', 'LettersSecurity', 'LettersFollowType', 'LettersResponseType', 'LettersResponseID', 'LettersAttachmentType', 'LettersArchiveType', 'UsersID_FK'], 'integer'],
            [['LettersSubject', 'LettersText', 'LettersAbstract', 'LettersCreateDate', 'LettersNumber', 'LettersResponseDate', 'LettersAttachmentUrl', 'LettersAttachmentFileName', 'fullNameCreator', 'persianLettersDraftType', 'persianLettersType', 'persianLettersTypeOfAction', 'persianLettersSecurity', 'persianLettersFollowType', 'persianLettersResponseType', 'persianLettersAttachmentType', 'persianLettersArchiveType'], 'safe'],
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
        if (Yii::$app->user->id) {

            $query = VwLetters::find()->where(['UsersID_FK' => Yii::$app->user->id])->andWhere(['LettersDraftType' => 1]);
        } else {
            throw new NotFoundHttpException('خطا در vwLetters');
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
        ]);

        $query->andFilterWhere(['like', 'LettersSubject', $this->LettersSubject])
            ->andFilterWhere(['like', 'LettersText', $this->LettersText])
            ->andFilterWhere(['like', 'LettersAbstract', $this->LettersAbstract])
            ->andFilterWhere(['like', 'LettersCreateDate', $this->LettersCreateDate])
            ->andFilterWhere(['like', 'LettersNumber', $this->LettersNumber])
            ->andFilterWhere(['like', 'LettersResponseDate', $this->LettersResponseDate])
            ->andFilterWhere(['like', 'LettersAttachmentUrl', $this->LettersAttachmentUrl])
            ->andFilterWhere(['like', 'LettersAttachmentFileName', $this->LettersAttachmentFileName])
            ->andFilterWhere(['like', 'fullNameCreator', $this->fullNameCreator])
            ->andFilterWhere(['like', 'persianLettersDraftType', $this->persianLettersDraftType])
            ->andFilterWhere(['like', 'persianLettersType', $this->persianLettersType])
            ->andFilterWhere(['like', 'persianLettersTypeOfAction', $this->persianLettersTypeOfAction])
            ->andFilterWhere(['like', 'persianLettersSecurity', $this->persianLettersSecurity])
            ->andFilterWhere(['like', 'persianLettersFollowType', $this->persianLettersFollowType])
            ->andFilterWhere(['like', 'persianLettersResponseType', $this->persianLettersResponseType])
            ->andFilterWhere(['like', 'persianLettersAttachmentType', $this->persianLettersAttachmentType])
            ->andFilterWhere(['like', 'persianLettersArchiveType', $this->persianLettersArchiveType]);

        return $dataProvider;
    }
}