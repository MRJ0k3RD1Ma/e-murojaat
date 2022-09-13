<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DeadlineChanges;

/**
 * DeadlineChangesSearch represents the model behind the search form of `app\models\DeadlineChanges`.
 */
class DeadlineChangesSearch extends DeadlineChanges
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'appeal_id', 'register_id', 'status_id'], 'integer'],
            [['comment', 'file', 'deadline', 'ads', 'created', 'updated'], 'safe'],
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
        $query = DeadlineChanges::find();

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
            'appeal_id' => $this->appeal_id,
            'register_id' => $this->register_id,
            'deadline' => $this->deadline,
            'status_id' => $this->status_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'ads', $this->ads]);

        return $dataProvider;
    }
}
