<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ServiceLots;

/**
 * ServiceLotsSearch represents the model behind the search form of `app\models\ServiceLots`.
 */
class ServiceLotsSearch extends ServiceLots
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'service_id', 'status'], 'integer'],
            [['lot_number', 'ads'], 'safe'],
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
        $query = ServiceLots::find();

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
            'id' => $this->id,
            'service_id' => $this->service_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'lot_number', $this->lot_number])
            ->andFilterWhere(['like', 'ads', $this->ads]);

        return $dataProvider;
    }
}
