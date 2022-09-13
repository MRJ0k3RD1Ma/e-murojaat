<?php

namespace app\models\search;

use yii\base\BaseObject;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Request;
use Yii;
/**
 * RequestSearch represents the model behind the search form of `app\models\Request`.
 */
class RequestSearch extends Request
{
    public $do,$sts=1;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','sts', 'sender_id', 'reciever_id', 'type_id', 'register_id', 'appeal_id', 'status_id'], 'integer'],
            [['detail', 'date', 'file', 'created', 'updated','do'], 'safe'],
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
        $query = Request::find()->where('reciever_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.')');

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

        if($this->do){
            if($this->do == 'time'){
                $query->andWhere('sender_id not in (select id from user where company_id='.Yii::$app->user->identity->company_id.')');
                $query->andWhere(['type_id'=>1]);
            }elseif($this->do == 'timemy'){
                $query->andWhere('sender_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.')');
                $query->andWhere(['type_id'=>1]);
            }elseif($this->do == 'reject'){
                $query->andWhere('sender_id not in (select id from user where company_id='.Yii::$app->user->identity->company_id.')');
                $query->andWhere(['type_id'=>2]);
            }elseif($this->do == 'rejectmy'){
                $query->andWhere('sender_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.')');
                $query->andWhere(['type_id'=>2]);
            }

        }

        $query->andWhere('status_id<='.$this->sts);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sender_id' => $this->sender_id,
            'reciever_id' => $this->reciever_id,
            'type_id' => $this->type_id,
            'register_id' => $this->register_id,
            'appeal_id' => $this->appeal_id,
            'status_id' => $this->status_id,
            'date' => $this->date,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }

    public function searchAll($params)
    {
        $query = Request::find()->where('sender_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.')')
        ->orderBy(['updated'=>SORT_DESC]);

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

        if($this->do){
            if($this->do == 'time'){
//                $query->andWhere('reciever_id not in (select id from user where company_id='.Yii::$app->user->identity->company_id.')');
                $query->andWhere(['type_id'=>1]);
            }elseif($this->do == 'timemy'){
//                $query->andWhere('reciever_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.')');
                $query->andWhere(['type_id'=>1]);
            }elseif($this->do == 'reject'){
//                $query->andWhere('reciever_id not in (select id from user where company_id='.Yii::$app->user->identity->company_id.')');
                $query->andWhere(['type_id'=>2]);
            }elseif($this->do == 'rejectmy'){
//                $query->andWhere('reciever_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.')');
                $query->andWhere(['type_id'=>2]);
            }
        }

//        $query->andWhere('status_id<='.$this->sts);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sender_id' => $this->sender_id,
            'reciever_id' => $this->reciever_id,
            'type_id' => $this->type_id,
            'register_id' => $this->register_id,
            'appeal_id' => $this->appeal_id,
            'status_id' => $this->status_id,
            'date' => $this->date,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }

    public function searchRes($params)
    {
        $query = Request::find()->where('sender_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.')')
            ->orderBy(['updated'=>SORT_DESC]);

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

        if($this->do){
            if($this->do == 'time'){
//                $query->andWhere('reciever_id not in (select id from user where company_id='.Yii::$app->user->identity->company_id.')');
                $query->andWhere(['type_id'=>1]);
            }elseif($this->do == 'timemy'){
//                $query->andWhere('reciever_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.')');
                $query->andWhere(['type_id'=>1]);
            }elseif($this->do == 'reject'){
//                $query->andWhere('reciever_id not in (select id from user where company_id='.Yii::$app->user->identity->company_id.')');
                $query->andWhere(['type_id'=>2]);
            }elseif($this->do == 'rejectmy'){
//                $query->andWhere('reciever_id in (select id from user where company_id='.Yii::$app->user->identity->company_id.')');
                $query->andWhere(['type_id'=>2]);
            }elseif($this->do == 'answered'){

                $query->andWhere('status_id>1');

            }
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sender_id' => $this->sender_id,
            'reciever_id' => $this->reciever_id,
            'type_id' => $this->type_id,
            'register_id' => $this->register_id,
            'appeal_id' => $this->appeal_id,
            'status_id' => $this->status_id,
            'date' => $this->date,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }



}
