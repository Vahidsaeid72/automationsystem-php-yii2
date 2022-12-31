<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jobs;

/**
 * JobsSearch represents the model behind the search form of `app\models\Jobs`.
 */
class JobsSearch extends VwJobs
{
    /**
     * {@inheritdoc}
     */



    public function rules()
    {
        return [
            [['JobsID', 'JobsLevel', 'JobsParentID', 'JobsStatus'], 'integer'],
            [['JobsName', 'JobsDescription', 'SubJobs'], 'safe'],
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
        $query = VwJobs::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>
            [
                'pageSizeParam' => false,
                'pageSize' => 10,

            ],
            'sort' =>
            [
                'defaultOrder' =>
                [
                    'JobsParentID' => SORT_ASC,
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
            'JobsID' => $this->JobsID,
            'JobsLevel' => $this->JobsLevel,
            'JobsParentID' => $this->JobsParentID,
            'JobsStatus' => $this->JobsStatus,
        ]);

        $query->andFilterWhere(['like', 'JobsName', $this->JobsName])
            ->andFilterWhere(['like', 'SubJobs', $this->SubJobs])
            ->andFilterWhere(['like', 'JobsDescription', $this->JobsDescription]);

        return $dataProvider;
    }
}