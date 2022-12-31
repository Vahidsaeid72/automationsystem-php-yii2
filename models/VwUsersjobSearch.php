<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VwUsersjob;
use yii\web\NotFoundHttpException;

/**
 * VwUsersjobSearch represents the model behind the search form of `app\models\VwUsersjob`.
 */
class VwUsersjobSearch extends VwUsersjob
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UsersJobID', 'UsersJobStatus', 'UsersID_FK', 'JobsID_FK', 'JobsID', 'JobsLevel', 'JobsParentID', 'JobsStatus'], 'integer'],
            [['UsersJobStartDate', 'UsersJobEndDate', 'JobsName', 'JobsDescription', 'FullName', 'PersianJobsStatus'], 'safe'],
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
        $jobID = $session->get('JobRotationID');
        if ($jobID) {
            $query = VwUsersjob::find()->where(['JobsID_FK' => $jobID]);
        } else {
            throw new NotFoundHttpException('خطا در VwUsersjobSearch');
        }

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
                    'UsersJobID' => SORT_DESC
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
            'UsersJobID' => $this->UsersJobID,
            'UsersJobStatus' => $this->UsersJobStatus,
            'UsersID_FK' => $this->UsersID_FK,
            'JobsID_FK' => $this->JobsID_FK,
            'JobsID' => $this->JobsID,
            'JobsLevel' => $this->JobsLevel,
            'JobsParentID' => $this->JobsParentID,
            'JobsStatus' => $this->JobsStatus,
        ]);

        $query->andFilterWhere(['like', 'UsersJobStartDate', $this->UsersJobStartDate])
            ->andFilterWhere(['like', 'UsersJobEndDate', $this->UsersJobEndDate])
            ->andFilterWhere(['like', 'JobsName', $this->JobsName])
            ->andFilterWhere(['like', 'JobsDescription', $this->JobsDescription])
            ->andFilterWhere(['like', 'FullName', $this->FullName])
            ->andFilterWhere(['like', 'PersianJobsStatus', $this->PersianJobsStatus]);

        return $dataProvider;
    }
}