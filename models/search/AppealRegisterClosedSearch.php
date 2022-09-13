<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AppealRegister;

/**
 * AppealRegisterSearch represents the model behind the search form of `app\models\AppealRegister`.
 */
class AppealRegisterClosedSearch extends AppealRegister
{
    public $question_id, $person_name,$person_phone,$gender,$date_of_birth,$region_id,$district_id,$village_id,$address;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'appeal_id', 'rahbar_id','question_id','gender', 'ijrochi_id','region_id','district_id','village_id', 'parent_bajaruvchi_id', 'deadline', 'status', 'control_id','company_id', 'answer_send', 'nazorat', 'takroriy', 'takroriy_id'], 'integer'],
            [['number', 'date', 'users','date_of_birth', 'person_name','person_phone','deadtime', 'donetime', 'created', 'updated', 'preview', 'detail', 'file', 'takroriy_date', 'takroriy_number'], 'safe'],
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
        $user = \Yii::$app->user->identity;
             $user = \Yii::$app->user->identity;

        $query = AppealRegister::find()->where(['appeal_register.company_id'=>$user->company_id])->innerJoin('appeal','appeal.id=appeal_register.appeal_id')
            ->andWhere(['=','appeal_register.status',4])->orderBy(['appeal_register.status'=>SORT_ASC,'appeal_register.deadtime'=>SORT_ASC]);

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
            'date' => $this->date,
            'appeal_id' => $this->appeal_id,
            'rahbar_id' => $this->rahbar_id,
            'ijrochi_id' => $this->ijrochi_id,
            'parent_bajaruvchi_id' => $this->parent_bajaruvchi_id,
            'deadline' => $this->deadline,
            'appeal_register.deadtime' => $this->deadtime,
            'donetime' => $this->donetime,
            'control_id' => $this->control_id,
            'appeal_register.status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
            'company_id' => $this->company_id,
            'answer_send' => $this->answer_send,
            'nazorat' => $this->nazorat,
            'takroriy' => $this->takroriy,
            'takroriy_id' => $this->takroriy_id,
            'takroriy_date' => $this->takroriy_date,

            'appeal.date_of_birth' => $this->date_of_birth,
            'appeal.gender' => $this->gender,
            'appeal.question_id' => $this->question_id,
            'appeal.region_id' => $this->region_id,
            'appeal.district_id' => $this->district_id,
            'appeal.village_id' => $this->village_id,
            'appeal.address' => $this->address,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'takroriy_number', $this->takroriy_number])
            ->andFilterWhere(['like', 'appeal.person_phone', $this->person_phone])
            ->andFilterWhere(['like', 'appeal.person_name', $this->person_name]);

        return $dataProvider;
    }
}
