<?php

namespace app\modules\admin\controllers;

use app\models\District;
use app\models\SchoolModel;
use app\models\User;
use app\models\CompModel;
use app\models\Village;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use app\models\Company;
use app\models\search\CompanySearch;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if(Yii::$app->request->isPost){

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $n = 0;
            $sheet->setCellValue('A1', '№');
            $sheet->setCellValue('B1', 'Ташкилот номи');
            $sheet->setCellValue('C1', 'Логин');
            $sheet->setCellValue('D1', 'Парол');
            $sheet->setCellValue('E1', 'Тўлов ҳолати');
            $sheet->setCellValue('F1', 'Телефон');
            $sheet->setCellValue('G1', 'Туман');
            foreach ($dataProvider->query->all() as $item){
                $n++;
                $m = $n+1;
                $sheet->setCellValue('A'.$m, $n);
                $sheet->setCellValue('B'.$m, $item->name);
                $sheet->setCellValue('C'.$m, $item->inn);
                $sheet->setCellValue('D'.$m, '1111');
                $sheet->setCellValue('E'.$m, $item->paid==1?'Тўлов қилинган':'Тўланмаган');
                $sheet->setCellValue('F'.$m, $item->phone);
                $sheet->setCellValue('G'.$m, $item->district_id);
            }

            $writer = new Xlsx($spreadsheet);
//            $writer->save("php://output");

            $writer->save('tashkilotlar.xlsx');
            Yii::$app->response->sendFile('tashkilotlar.xlsx');
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();
        $model->region_id = 12;
        /*$model->district_id = 2;
        $model->village_id = 68;*/
        $model->inn = rand(1000,1000000);
        $model->password = 123;

        $model->address = '-';
        $user = new User();
        $user->lavozim_id = 13;
        $user->is_rahbar = 1;
        $user->is_registration = 1;
        $user->is_resolution = 1;
        $user->address = '-';
        $user->company_id = 0;
        $model->group_id = 14;
        $model->type_id = 52;
        if ($model->load(Yii::$app->request->post())) {
            $model->encrypt();
            if($model->save()){
                if($user->load(Yii::$app->request->post())){
                    $user->company_id = $model->id;
                    $user->encrypt();
                    $user->save();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                echo "<pre>";
                var_dump($model);
                exit;
            }
        }

        return $this->render('create', [
            'model' => $model,
            'user'=>$user,
        ]);
    }

    public function actionUpdateuser($id)
    {
        $model = User::findOne($id);
        $password = $model->password;
        $company = Company::findOne($model->company_id);
        $model->password = "";
        if ($model->load(Yii::$app->request->post())) {
            if ($model->password) {
                $model->encrypt();
            } else {
                $model->password = $password;
            }
            if ($model->save()) {

                return $this->redirect(['view', 'id' => $model->company_id]);
            } else {
                echo "<pre>";
                var_dump($model);
                exit;
            }
        }
        return $this->render('adduser', [
            'model' => $model,
            'company'=>$company
        ]);
    }

    public function actionDeleteuser($id,$com){

        if($user = User::findOne($id)){
            $user->delete();
        }
        return $this->redirect(['view','id'=>$com]);
    }
    public function actionAdduser($id)
    {
        $model = new User();
        $model->scenario = 'insert';
        $company = Company::findOne($id);
        $model->company_id = $company->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->encrypt();
            if($model->save()){
                return $this->redirect(['view', 'id' => $id]);
            }else{
                echo "<pre>";
                var_dump($model);
                exit;
            }
        }

        return $this->render('adduser', [
            'model' => $model,
            'company'=>$company
        ]);
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCheck($inn){
        if(Company::findOne(['inn'=>$inn])){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function actionCreatewithdist(){
        $model = new CompModel();
        $model->name = '{region} {bulim}';
        $model->username = "{login}";
        $model->password = "1111";
        $dist = District::find()->where(['region_id'=>12])->all();
        if($model->load(Yii::$app->request->post())){


            $com = new Company();

            $com->region_id = 12;
            $com->district_id = 11;
            $com->village_id = Village::findOne(['district_id'=>$com->district_id])->id;
            $com->address = '-';

            $com->inn = str_replace('{login}',"xorazm",$model->username);
            $com->password = 1111;
            $com->name = str_replace('{region}',"Хоразм вилоят",$model->name);
            $com->name = str_replace('{bulim}',"бошқармаси",$com->name);
            $com->director = $com->name;
            $com->phone = "-";
            $com->group_id = 14;
            $com->type_id = 52;
            $com->encrypt();
            $com->save();

            $user = new User();
            $user->username = $com->inn;
            $user->lavozim_id = 13;
            $user->is_rahbar = 1;
            $user->is_registration = 1;
            $user->is_resolution = 1;
            $user->address = '-';
            $user->name = $com->name;
            $user->phone = "-";
            $user->address = "-";
            $user->role_id = 1;
            $user->bulim_id = 1;
            $user->company_id = $com->id;
			$user->password = $model->password;
            $user->encrypt();
            $user->save();

            foreach ($dist  as $item){

                $com = new Company();

                $com->region_id = 12;
                $com->district_id = $item->id;
                $com->village_id = Village::findOne(['district_id'=>$item->id])->id;
                $com->address = '-';

                $com->inn = str_replace('{login}',$model->getCode($item->id),$model->username);
                $com->password = 1111;
                $com->name = str_replace('{region}',$item->name,$model->name);
                $com->name = str_replace('{bulim}',"бўлими",$com->name);
                $com->director = $com->name;
                $com->phone = "-";
                $com->group_id = 14;
                $com->type_id = 52;
                $com->encrypt();
                $com->save();
                $user = new User();
                $user->username = $com->inn;
                $user->lavozim_id = 13;
                $user->is_rahbar = 1;
                $user->is_registration = 1;
                $user->is_resolution = 1;
                $user->address = '-';
                $user->name = $com->name;
                $user->phone = "-";
				$user->password = $com->password;
                $user->address = "-";
                $user->role_id = 1;
                $user->bulim_id = 1;
                $user->company_id = $com->id;
//                $user->encrypt();
                $user->save();

            }

        }
        return $this->render('createwd',[
            'model'=>$model
        ]);

    }


    public function actionGeneratekomplex($id){
        $model = new CompModel();
        $model->name = '{region} {bulim}';
        $model->username = "{login}";
        $model->password = "1111";
        $dist = District::find()->where(['region_id'=>12])->all();
        if($model->load(Yii::$app->request->post())){
            // hokim
            $user = new User();
            $user->username = str_replace('{login}',"hokim",$model->username);
            $user->lavozim_id = 1;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;
            $user->bulim_id = 1;
            $user->address = '-';
            $user->name = "Ҳоким";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();

            // 1-o'rinbosar
            $user = new User();
            $user->username = str_replace('{login}',"hok1",$model->username);
            $user->lavozim_id = 4;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;
            $user->bulim_id = 3;
            $user->address = '-';
            $user->name = "Биринчи ўринбосар";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();
            $user = null;

            // Ўринбосар Ҳокимнинг саноатни ривожлантириш, капитал қурилиш, коммуникациялар ва коммунал хўжалик масалалари бўйича комплекси
            $user = new User();
            $user->username = str_replace('{login}',"hok2",$model->username);
            $user->lavozim_id = 5;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;

            $user->bulim_id = 4;

            $user->address = '-';
            $user->name = "Ўринбосар";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();
            $user = null;

            //Ўринбосар Ҳокимнинг инвестициялар, инновациялар, хусусийлаштирилган корхоналарга кўмаклашиш, эркин иқтисодий ва кичик саноат зоналарини ривожлантириш масалалари бўйича комплекси
            $user = new User();
            $user->username = str_replace('{login}',"hok3",$model->username);
            $user->lavozim_id = 5;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;
            $user->bulim_id = 5;
            $user->address = '-';
            $user->name = "Ўринбосар";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();
            $user = null;

            //Ўринбосар Ҳокимнинг қишлоқ ва сув хўжалик масалалари бўйича комплекси
            $user = new User();
            $user->username = str_replace('{login}',"hok4",$model->username);
            $user->lavozim_id = 5;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;
            $user->bulim_id = 6;
            $user->address = '-';
            $user->name = "Ўринбосар";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();
            $user = null;

            //Ўринбосар Ҳокимнинг туризм, спорт,маданият,маданий мерос ва оммавий коммуникациялар масалалари бўйича комплекси
            $user = new User();
            $user->username = str_replace('{login}',"hok5",$model->username);
            $user->lavozim_id = 5;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;
            $user->bulim_id = 7;
            $user->address = '-';
            $user->name = "Ўринбосар";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();
            $user = null;

            //Ўринбосар Ҳокимнинг ёшлар сиёсати, ижтимоий ривожлантириш ва маънавий маърифий  ишлар бўйича комплекси
            $user = new User();
            $user->username = str_replace('{login}',"hok6",$model->username);
            $user->lavozim_id = 5;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;
            $user->bulim_id = 8;
            $user->address = '-';
            $user->name = "Ўринбосар";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();
            $user = null;

            //Ўринбосар Ҳокимнинг жамоат ва диний ташкилотлар билан алоқалар бўйича комплекси
            $user = new User();
            $user->username = str_replace('{login}',"hok7",$model->username);
            $user->lavozim_id = 5;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;
            $user->bulim_id = 9;
            $user->address = '-';
            $user->name = "Ўринбосар";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();
            $user = null;

            //Ўринбосар Ҳокимининг ўринбосари - вилоят маҳалла ва оилани  қўллаб-қувватлаш бошқармаси
            $user = new User();
            $user->username = str_replace('{login}',"hok8",$model->username);
            $user->lavozim_id = 5;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;
            $user->bulim_id = 10;
            $user->address = '-';
            $user->name = "Ўринбосар";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();
            $user = null;

            // Ҳокимининг ахборот сиёсати масалалари бўйича маслаҳатчиси - Матбуот котиби
            $user = new User();
            $user->username = str_replace('{login}',"hok9",$model->username);
            $user->lavozim_id = 11;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;
            $user->bulim_id = 11;
            $user->address = '-';
            $user->name = "Ҳокимининг ахборот сиёсати масалалари бўйича маслаҳатчиси - Матбуот котиби";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();
            $user = null;

            //Ташкилий-назорат гуруҳи
            $user = new User();
            $user->username = str_replace('{login}',"hok10",$model->username);
            $user->lavozim_id = 7;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;
            $user->bulim_id = 12;
            $user->address = '-';
            $user->name = "Ташкилий-назорат гуруҳи";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();
            $user = null;

            //Вояга етмаганлар ишлари бўйича комиссиясининг масъул котиби
            $user = new User();
            $user->username = str_replace('{login}',"hok11",$model->username);
            $user->lavozim_id = 12;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;
            $user->bulim_id = 14;
            $user->address = '-';
            $user->name = "Вояга етмаганлар ишлари бўйича комиссиясининг масъул котиби";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();
            $user = null;

            //Юридик хизмат
            $user = new User();
            $user->username = str_replace('{login}',"hok13",$model->username);
            $user->lavozim_id = 17;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;
            $user->bulim_id = 15;
            $user->address = '-';
            $user->name = "Юридик хизмат";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();
            $user = null;

            //Ўринбосар  Хотин кизлар буйича хоким уринбосари
            $user = new User();
            $user->username = str_replace('{login}',"hok14",$model->username);
            $user->lavozim_id = 5;
            $user->is_rahbar = 1;
            $user->is_resolution = 1;
            $user->role_id = 1;
            $user->bulim_id = 19;
            $user->address = '-';
            $user->name = "Ўринбосар";
            $user->phone = "-";
            $user->password = $model->password;
            $user->encrypt();
            $user->address = "-";
            $user->company_id = $id;
            $user->save();
            $user = null;

        }
        return $this->render('gencomp',[
            'model'=>$model,
        ]);
    }


    public function actionGensubcomp(){
        $model = new CompModel();
        $model->name = '{num}';
        $model->username = "";
        $model->password = "1111";

        if($model->load(Yii::$app->request->post())){

            for($i = 1; $i<=$model->cnt; $i++){
                $com = new Company();

                $com->region_id = $model->region;
                $com->district_id = $model->district;
                $com->village_id = Village::findOne(['district_id'=>$model->district])->id;
                $com->address = '-';

                $com->inn = $com->inn . $i;
                $com->password = 1111;
                $com->name = str_replace('{num}',$i,$model->name);
                $com->director = $com->name;
                $com->phone = "-";
                $com->group_id = 14;
                $com->type_id = 52;
                $com->encrypt();
                $com->save();
                $user = new User();
                $user->username = $com->inn;
                $user->lavozim_id = 13;
                $user->is_rahbar = 1;
                $user->is_registration = 1;
                $user->is_resolution = 1;
                $user->address = '-';
                $user->name = $com->name;
                $user->phone = "-";
                $user->password = $com->password;
                $user->address = "-";
                $user->role_id = 1;
                $user->bulim_id = 1;
                $user->company_id = $com->id;
//                $user->encrypt();
                $user->save();
            }

        }
        return $this->render('gensubcomp',[
            'model'=>$model
        ]);

    }


    public function actionSchool(){
        $model = new SchoolModel();
        if($model->load(Yii::$app->request->post())){
            for($i = 1; $i<=$model->count; $i++){
                $com = new Company();

                $com->region_id = $model->region;
                $com->district_id = $model->district;
                $com->village_id = Village::findOne(['district_id'=>$model->district])->id;
                $com->address = '-';

                $com->inn = str_replace('{number}',$i,$model->username);
                $com->password = 1111;
                $com->name = str_replace('{number}',$i,$model->name);
                $com->director = $com->name;
                $com->phone = "-";
                $com->group_id = 14;
                $com->type_id = 52;
                $com->encrypt();
                $com->save();
                $user = new User();
                $user->username = $com->inn;
                $user->lavozim_id = 13;
                $user->is_rahbar = 1;
                $user->is_registration = 1;
                $user->is_resolution = 1;
                $user->address = '-';
                $user->name = $com->name;
                $user->phone = "-";
                $user->password = $com->password;
                $user->address = "-";
                $user->role_id = 1;
                $user->bulim_id = 1;
                $user->company_id = $com->id;
//                $user->encrypt();
                $user->save();
            }
        }
        return $this->render('school',[
            'model'=>$model
        ]);
    }
	
	public function actionVillage(){
		$model = new SchoolModel();
		if($model->load(Yii::$app->request->post())){
			$vil = Village::find()->where(['district_id'=>$model->district])->all();
			$dist_name = District::findOne($model->district)->name;
			foreach($vil  as $item){
				$com = new Company();

                $com->region_id = $model->region;
                $com->district_id = $model->district;
                $com->village_id = $item->id;
                $com->address = '-';

                $com->inn = 'mfy'.$item->id;
                $com->password = 1111;
                $com->name = $dist_name.' '.$item->name;
                $com->director = $com->name;
                $com->phone = "-";
                $com->group_id = 14;
                $com->type_id = 52;
                $com->encrypt();
                $com->save();
                $user = new User();
                $user->username = $com->inn;
                $user->lavozim_id = 13;
                $user->is_rahbar = 1;
                $user->is_registration = 1;
                $user->is_resolution = 1;
                $user->address = '-';
                $user->name = $com->name;
                $user->phone = "-";
                $user->password = $com->password;
                $user->address = "-";
                $user->role_id = 1;
                $user->bulim_id = 1;
                $user->company_id = $com->id;
//                $user->encrypt();
                $user->save();
				
			}
		}
		
		return $this->render('school',[
			'model'=>$model,
		]);
	}
	
	public function actionVillageregen(){
		$model = Company::find()->filterWhere(['like','inn','mfy'])->all();
		foreach($model as $item){
			$item->name = District::findOne($item->district_id)->name.' '.Village::findOne($item->village_id)->name;
			$item->save();
		}
		
		return $this->redirect(['index']);
	}

    public function actionPaid($id,$url=0){

        $model = Company::findOne($id);
        $model->scenario = 'paidtime';
        $model->redirect = $url;
        $model->paid_date = "";
        $model->paid = 1;
        if($model->load(Yii::$app->request->post())){

            if($model->save()){
                if($url){
                    return $this->redirect([$url]);
                }else{
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->renderAjax('_paid',['model'=>$model]);


    }
}
