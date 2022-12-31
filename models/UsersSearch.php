<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form of `app\models\Users`.
 */
class UsersSearch extends VwUsers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UsersID', 'UsersGender', 'UsersActivity'], 'integer'],
            [['UsersName', 'UsersFamily', 'UsersUserName', 'UsersPassword', 'UsersEmail', 'UsersPhone', 'UsersMobile', 'UsersPicture', 'UsersSignature', 'PersianUsersGender', 'PersianUsersActivity'], 'safe'],
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
        $query = VwUsers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'UsersID' => $this->UsersID,
            'UsersGender' => $this->UsersGender,
            'UsersActivity' => $this->UsersActivity,
        ]);

        $query->andFilterWhere(['like', 'UsersName', $this->UsersName])
            ->andFilterWhere(['like', 'UsersFamily', $this->UsersFamily])
            ->andFilterWhere(['like', 'UsersUserName', $this->UsersUserName])
            ->andFilterWhere(['like', 'UsersPassword', $this->UsersPassword])
            ->andFilterWhere(['like', 'UsersEmail', $this->UsersEmail])
            ->andFilterWhere(['like', 'UsersPhone', $this->UsersPhone])
            ->andFilterWhere(['like', 'UsersMobile', $this->UsersMobile])
            ->andFilterWhere(['like', 'UsersPicture', $this->UsersPicture])
            ->andFilterWhere(['like', 'UsersSignature', $this->UsersSignature])
            ->andFilterWhere(['like', 'PersianUsersGender', $this->PersianUsersGender])
            ->andFilterWhere(['like', 'PersianUsersActivity', $this->PersianUsersActivity]);

        return $dataProvider;
    }
}