<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AppealAnswer;
use Yii;
/**
 * AppealAnswerSearch represents the model behind the search form of `app\models\AppealAnswer`.
 */
class AppealAnswerSearch extends AppealAnswer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'appeal_id', 'register_id', 'bajaruvchi_id', 'reaply_send', 'status', 'status_boshqa'], 'integer'],
            [['preview', 'detail', 'number', 'date', 'tarqatma_number', 'tarqatma_date', 'name', 'file', 'created', 'updated'], 'safe'],
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
        $query = AppealAnswer::find()->select(['appeal_answer.*'])
            ->innerJoin('appeal_register','appeal_register.id = appeal_answer.register_id')
            ->where('appeal_register.parent_bajaruvchi_id IN (SELECT ar.id FROM appeal_register ar WHERE ar.company_id='.Yii::$app->user->identity->company_id.')')
//            ->andWhere(['appeal_answer.status_boshqa'=>0])
            ->orderBy(['created'=>SORT_DESC])
        ;
/*
 SELECT
  appeal_answer.*
FROM appeal_answer
INNER JOIN appeal_register ON appeal_register.id = appeal_answer.register_id
where appeal_register.parent_bajaruvchi_id IN (SELECT ar.id FROM appeal_register ar WHERE ar.company_id=1)
ORDER BY appeal_answer.created DESC

  */
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
            'date' => $this->date,
            'tarqatma_date' => $this->tarqatma_date,
            'bajaruvchi_id' => $this->bajaruvchi_id,
            'reaply_send' => $this->reaply_send,
            'status' => $this->status,
            'status_boshqa' => $this->status_boshqa,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'tarqatma_number', $this->tarqatma_number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
