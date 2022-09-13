<?php

namespace app\controllers;


use app\models\Company;
use app\models\CompanyType;
use app\models\District;
use app\models\Village;
use yii\web\Controller;


class GetController extends Controller
{

    public function actionDistrict($id){
        $model = District::find()->where(['region_id'=>$id])->all();
        $res = "<option value=''>-Tumanni tanlang-</option>";
        foreach ($model as $item) {
            $res .= "<option value='{$item->id}'>{$item->name}</option>";
        }
        echo $res;
        exit;
    }

    public function actionVillage($id){
        $model = Village::find()->where(['district_id'=>$id])->all();
        $res = "<option value=''>-Mahallani tanlang-</option>";
        foreach ($model as $item) {
            $res .= "<option value='{$item->id}'>{$item->name}</option>";
        }
        echo $res;
        exit;
    }

    public function actionVillages($id){
        $res = "";
        $model = Village::find()->where(['district_id'=>$id])->all();
        $n=0;
        foreach ($model as $item) {
            $n++;
            $res .= "<div class=\"form-group field-user-vil-{$item->id}\">
    <label class=\"control-label\" for=\"user-vil-{$item->id}\">{$n}. {$item->name} </label>
    <input type=\"hidden\" name=\"User[vil][{$item->id}]\" value=\"0\"><label><input type=\"checkbox\" id=\"user-vil-{$item->id}\" name=\"User[vil][{$item->id}]\" value=\"1\"> </label>
    
    <div class=\"help-block\"></div>
    </div>";
        }
        echo $res;
        exit;
    }

    public function actionCompanyType($id){
        $model = CompanyType::find()->where(['group_id'=>$id])->all();
        $res = "<option>-Ташкилот турини-</option>";
        foreach ($model as $item) {
            $res .= "<option value='{$item->id}'>{$item->name}</option>";
        }
        echo $res;
        exit;
    }

    public function actionGettashkilot(){
## Read value
        $draw = isset($_POST['draw']) ? $_POST['draw'] : 1;
        $row = isset($_POST['start']) ? $_POST['start'] : 0;
        $rowperpage = isset($_POST['length']) ? $_POST['length'] : 10; // Rows display per page
        $columnIndex = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0; // Column index
        $columnName = isset($_POST['columns'][$columnIndex]['data']) ? $_POST['columns'][$columnIndex]['data'] : null; // Column name
        $columnSortOrder = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc'; // asc or desc
//        $searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : ''; // Search value
        if(isset($_POST['search']['value'])){
            $searchValue = $_POST['search']['value'];
        }else{
            $searchValue = null;
        }
## Search
        $searchQuery = "";
        if($searchValue != null){
            $searchQuery = " and (name like '%".$searchValue."%' or 
            director like '%".$searchValue."%' or 
            inn like'%".$searchValue."%' ) ";
        }

        ## Total number of records without filtering
        $comid = \Yii::$app->user->identity->company_id;

        $totalRecords = Company::find()->where(['<>','id',$comid])->count('id');

        ## Total number of records with filtering

        $totalRecordwithFilter = Company::find()->where('id<>'.$comid.' '.$searchQuery)->count('id');



        $empRecords = Company::find()->where('id<>'.$comid.' '. $searchQuery)->orderBy([$columnName => $columnSortOrder != 'asc' ? SORT_DESC : SORT_ASC])->limit($rowperpage)->offset($row)->all();

        $data = array();

        foreach ($empRecords as $item){
            $data[] = array(
                'id'=>"<button type='button' class='btn btn-success buttontashkilotadd' onclick='tashkilotadd({$item->id})' value='".$item->id."'><span class='fa fa-plus'></span></button>",
                'name'=>"<span class='trtashkilotlist{$item->id}'>{$item->name}</span>",
                'director'=>$item->director,
                'inn'=>$item->inn,
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);

        exit;
    }
}
