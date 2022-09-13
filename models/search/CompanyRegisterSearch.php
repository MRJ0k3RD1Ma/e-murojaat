<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Company;
use Yii;
/**
 * CompanySearch represents the model behind the search form of `app\models\Company`.
 */
class CompanyRegisterSearch extends Company
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'management', 'type_id', 'group_id', 'region_id', 'district_id', 'village_id'], 'integer'],
            [['inn', 'password', 'name', 'director', 'phone', 'telegram', 'active_to', 'active_each', 'created', 'updated', 'address'], 'safe'],
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


        $query = Company::find()->select(['company.*','COUNT(appeal_bajaruvchi.company_id) as cntall',
            '(select count(appeal_bajaruvchi.id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.company_id=company.id and appeal_bajaruvchi.status=0 and appeal_bajaruvchi.register_id in (select id from appeal_register where company_id='.Yii::$app->user->identity->company_id.')) as cnt0',
            '(select count(appeal_bajaruvchi.id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.company_id=company.id and appeal_bajaruvchi.status=1  and appeal_bajaruvchi.register_id in (select id from appeal_register where company_id='.Yii::$app->user->identity->company_id.')) as cnt1',
            '(select count(appeal_bajaruvchi.id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.company_id=company.id and appeal_bajaruvchi.status=2  and appeal_bajaruvchi.register_id in (select id from appeal_register where company_id='.Yii::$app->user->identity->company_id.')) as cnt2',
            '(select count(appeal_bajaruvchi.id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.company_id=company.id and appeal_bajaruvchi.status=3  and appeal_bajaruvchi.register_id in (select id from appeal_register where company_id='.Yii::$app->user->identity->company_id.')) as cnt3',
            '(select count(appeal_bajaruvchi.id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.company_id=company.id and appeal_bajaruvchi.status=4  and appeal_bajaruvchi.register_id in (select id from appeal_register where company_id='.Yii::$app->user->identity->company_id.')) as cnt4',
            '(select count(appeal_bajaruvchi.id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.company_id=company.id and appeal_bajaruvchi.status=5  and appeal_bajaruvchi.register_id in (select id from appeal_register where company_id='.Yii::$app->user->identity->company_id.')) as cnt5',
            '(select count(appeal_bajaruvchi.id) from appeal_bajaruvchi WHERE appeal_bajaruvchi.company_id=company.id and appeal_bajaruvchi.deadtime<date(now()) and appeal_bajaruvchi.status<>4 and appeal_bajaruvchi.register_id in (select id from appeal_register where company_id='.Yii::$app->user->identity->company_id.')) as cntdead',
        ])->leftJoin('appeal_bajaruvchi','appeal_bajaruvchi.company_id = company.id ')
            ->where('appeal_bajaruvchi.register_id in (SELECT appeal_register.id FROM appeal_register WHERE appeal_register.company_id='.Yii::$app->user->identity->company_id.') ')
            ->groupBy(['appeal_bajaruvchi.company_id'])
            ->orderBy(['cntall'=>SORT_DESC]);

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
            'active_to' => $this->active_to,
            'active_each' => $this->active_each,
            'created' => $this->created,
            'updated' => $this->updated,
            'status' => $this->status,
            'management' => $this->management,
            'type_id' => $this->type_id,
            'group_id' => $this->group_id,
            'region_id' => $this->region_id,
            'district_id' => $this->district_id,
            'village_id' => $this->village_id,
        ]);

        $query->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'director', $this->director])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
