<?php

namespace app\controllers;

use app\models\Appeal;
use app\models\AppealAnswer;
use app\models\AppealBajaruvchi;
use app\models\AppealComment;
use app\models\AppealRegister;
use app\models\Request;
use app\models\search\AppealBajaruvchiSearch;
use app\models\search\AppealRegisterHasSearch;
use app\models\search\AppealRegisterSearch;
use app\models\search\AppealSearch;
use app\models\search\RequestSearch;
use app\models\TaskEmp;
use app\models\User;
use PhpOffice\PhpWord\TemplateProcessor;
use Yii;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\NotAcceptableHttpException;
use yii\web\UploadedFile;

class AppealController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],

                    ],
                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity->is_registration === 1;
                    }
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'deletetask' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($type = null)
    {

        $searchModel = new AppealRegisterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$type);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id,$ans = 0){
        $register = AppealRegister::findOne($id);
        $model = Appeal::findOne($register->appeal_id);
        if(!$register->parent_bajaruvchi_id and $model->status < 2){
            $model->status = 2;
            $model->save();
        }
        if($model->status == 4){
            $register->status = 4;
            $register->save();
            if($register->parent_bajaruvchi_id){
                $parent = $register->parent;
                $parent->status = 4;
                $parent->save();
            }
            $emp = TaskEmp::find()->where(['appeal_id'=>$model->id])->andWhere(['register_id'=>$register->id])->all();
            foreach ($emp as $item) {
                $item->status = 4;
                $item->save();
            }
        }

        $answer = new AppealAnswer();
        $answer->appeal_id = $model->id;
        $answer->register_id = $register->id;


        $changetime = new Request();
        $changetime->status_id = 0;
        $changetime->type_id = 1;
        $changetime->sender_id = Yii::$app->user->id;
        $changetime->appeal_id = $model->id;
        $changetime->scenario = "change";
        $changetime->register_id = $register->id;
        if($register->parent_bajaruvchi_id){
            $changetime->reciever_id = $register->parent->register->rahbar_id;
        }else{
            $changetime->reciever_id = $register->rahbar_id;
        }

        $reject = new Request();
        $reject->status_id = 0;
        $reject->type_id = 2;
        $reject->sender_id = Yii::$app->user->id;
        $reject->appeal_id = $model->id;
        $reject->scenario = "reject";
        $reject->register_id = $register->id;
        if($register->parent_bajaruvchi_id){
            $reject->reciever_id = $register->parent->register->rahbar_id;
        }else{
            $reject->reciever_id = $register->rahbar_id;
        }



        return $this->render('view',[
            'model'=>$model,
            'register'=>$register,
            'answer'=>$answer,
            'changetime'=>$changetime,
            'reject'=>$reject
        ]);


    }

    public function actionGetappeal($id){

        $register = AppealRegister::findOne($id);
        $model = Appeal::findOne($register->appeal_id);
        $address = $model->region->name.' '.$model->district->name.' '.@$model->village->name.' '.$model->address;
        $word = new TemplateProcessor(Yii::$app->basePath.'/web/template/getappeal.docx');
        $word->setValue('companyup',mb_strtoupper(\app\models\Company::findOne(1)->name));
        $word->setValue('number',strip_tags($register->number));
        $word->setValue('questiongroup',strip_tags($model->question->group->name));

        $word->setValue('question',$model->question->name);

        $word->setValue('company',$model->company->name);
        $word->setValue('date',$register->date);
        $word->setValue('person_name',strip_tags($model->person_name));
        $word->setValue('address',strip_tags($address));
//        $word->setValue('sector',$register->number);
        $word->setValue('gender',Yii::$app->params['gender'][$model->gender]);
        $word->setValue('birthday',@$model->date_of_birth);
        $word->setValue('isbusiness',Yii::$app->params['yur'][$model->isbusinessman]);
        $word->setValue('businesname',@$model->businessman);
        $word->setValue('phone',strip_tags($model->person_phone));
        $word->setValue('deadline',$register->deadline.' кун '.$register->deadtime.' гача');
        $word->setValue('detail',strip_tags($model->appeal_detail));
        $word->setValue('tocompany',Yii::$app->user->identity->company->name.'га');
		
        $fileName = 'e-murojaat.uz_'.$register->id.'.docx';
        $fullname = Yii::$app->basePath.'/web/template/temp/e-murojaat.uz_'.$register->id.'.docx';
		
        $word->saveAs($fullname);
		
        //header('Content-Disposition: attachment; name=' . $fullname);
        $file = fopen($fullname, 'r+');
        Yii::$app->response->sendFile($fullname, $fileName, ['inline' => false, 'mimeType' => 'application/word'])->send();
        
        exit;
    }

    public function actionTask($id,$regid){
        $register = AppealRegister::findOne($regid);
        $model = new AppealBajaruvchi();
        $model->register_id = $register->id;
        $model->appeal_id = $register->appeal_id;
        $model->company_id = $id;
        $model->deadtime = $register->deadtime;
        if(AppealBajaruvchi::find()->where(['company_id'=>$id])->andWhere(['appeal_id'=>$model->appeal_id])->andWhere(['register_id'=>$register->id])->one()){
            return "Ушбу ташкилотга аввал мурожаат юборилган";
        }
        if($model->load(Yii::$app->request->post())){
            $model->sender_id = $register->rahbar_id;
            $model->upload();
            if($model->save()){
                Yii::$app->session->setFlash('success','Топшириқ юборилди');
            }else{
                Yii::$app->session->setFlash('error','Маълумотлар тўлиқ тўлдирилмаган');
            }
            return $this->redirect(['view','id'=>$regid]);
        }
        return $this->renderAjax('view/_send_task',[
            'model'=>$model,
            'id'=>$id,
            'regid'=>$regid
        ]);
    }

    public function actionSendrequest(){
        $model = new Request();
        $model->status_id = 0;
        if($model->load(Yii::$app->request->post())){

            if($model->save()){
                Yii::$app->session->setFlash('success','Сўров мувоффақиятли юборилди');
                // muddatni uzaytirishda tashkilotga tegishli murojaat bo'lsa uni bajarib yuborish yani parent null bo'lsa
                if($model->type_id == 1 and !$model->register->parent_bajaruvchi_id){
                    changeTime($model->id);
                }

            }else{
                Yii::$app->session->setFlash('error','Сўров маълумотлари тўлиқ эмас');
            }
        }
        return $this->redirect(['view','id'=>$model->register_id]);
    }

    public function actionUpdateappeal($id){
        $register = AppealRegister::findOne($id);
        if($register->parent_bajaruvchi_id){
            throw new NotAcceptableHttpException(Yii::t('yii', 'Sizga bu murojaatni ma`lumotlarini o`zgartirishga ruhsat berilmagan'));
        }

        $model = Appeal::findOne($register->appeal_id);
        if($model->load(Yii::$app->request->post())){
            $model->uploadAppeal();
            $model->save();
            Yii::$app->session->setFlash('success','Murojaatdagi o`zgarishlar saqlandi.');
            return $this->redirect(['view','id'=>$register->id]);
        }

        return $this->render('updateappeal',['model'=>$model]);

    }

    public function actionUpdateregister($id){
        $register = AppealRegister::findOne($id);
        if($register->company_id != Yii::$app->user->identity->company_id){
            throw new NotAcceptableHttpException(Yii::t('yii', 'Sizga bu murojaatni ma`lumotlarini o`zgartirishga ruhsat berilmagan'));
        }

        return $this->render('updateregister',['model'=>$register]);
    }

    public function actionTaskemp($id,$regid){
        $register = AppealRegister::findOne($regid);
        $model = new TaskEmp();
        $model->register_id = $register->id;
        $model->appeal_id = $register->appeal_id;
        $model->sender_id = $register->rahbar_id;
        $model->reciever_id = $id;
        $model->deadtime = $register->deadtime;
        if(TaskEmp::find()->where(['sender_id'=>$model->sender_id])
                ->andWhere(['reciever_id'=>$id])
                ->andWhere(['appeal_id'=>$model->appeal_id])
                ->andWhere(['register_id'=>$register->id])->one()
        ){
            return "Ушбу ҳодимга аввал топшириқ берилган юборилган";
        }
        if($model->load(Yii::$app->request->post())){

            $model->upload();
            if($model->save()){
                Yii::$app->session->setFlash('success','Топшириқ юборилди');
            }else{
                Yii::$app->session->setFlash('error','Маълумотлар тўлдирилмаган');
            }
            return $this->redirect(['view','id'=>$regid]);
        }
        return $this->renderAjax('view/_send_task_emp',[
            'model'=>$model,
            'id'=>$id,
            'regid'=>$regid,
            'name'=>User::findOne($model->reciever_id)->name,
        ]);
    }

    public function actionClosemy($id){
        $register = AppealRegister::findOne($id);
        $model = Appeal::findOne($register->appeal_id);
        $model->scenario = "close";

        $model->status = 4;
        if($model->load(Yii::$app->request->post())){
            if($model->answer_file = UploadedFile::getInstance($model,'answer_file')){
                $name = microtime(true).'.'.$model->answer_file->extension;
                $model->answer_file->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
                $model->answer_file = $name;
            }
            if($model->save()){
                $register->status = 4;
                $register->donetime = date('Y-m-d');
                $register->control_id = $model->appeal_control_id;
                $register->answer_send = $model->answer_reply_send;
                $register->save();
                closeAppeal($model->id,$register->id,$register->control_id);
            }
        }
        return $this->redirect(['view','id'=>$register->id]);
    }

    public function actionClose($id,$ansid){
        $register = AppealRegister::findOne($id);
        $model = Appeal::findOne($register->appeal_id);
        $model->scenario = "close";
        $answer = AppealAnswer::findOne($ansid);
        $bajaruvchi = $answer->parent;
        $model->answer_file = $answer->file;
        $model->status = 4;
        if($model->load(Yii::$app->request->post()) and $model->save()){
            $register->status = 4;
            $register->donetime = date('Y-m-d');
            $register->control_id = $model->appeal_control_id;
            $register->answer_send = $model->answer_reply_send;
            $register->save();
            $bajaruvchi->status = 4;
            $bajaruvchi->save(false);
            $answer->status = 4;
            $answer->save(false);
            closeAppeal($model->id,$register->id,$register->control_id);
            //return $this->redirect(['acceptanswer','id'=>$ansid]);
        }
        return $this->redirect(['view','id'=>$register->id]);
    }


    public function actionAnswered($status = 3){
        $searchModel = new AppealBajaruvchiSearch();
        $searchModel->status = $status;
        $type = 'answered';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$type);

        return $this->render('answered', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    public function actionAnswerlist(){

        $searchModel = new AppealRegisterHasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('answerlist',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }




    public function actionAnswer($id,$ansid=0){

        $register = AppealRegister::findOne($id);
        $file = null;

        $model = new AppealAnswer();
        $model->appeal_id = $register->appeal_id;
        $model->register_id = $register->id;
        $model->date = date('Y-m-d');
        $model->bajaruvchi_id = Yii::$app->user->id;
        $model->tarqatma_date = date('Y-m-d');
        $model->parent_id = $register->parent_bajaruvchi_id;
        $model->status = 3;
        if($ansid != 0){
            $old = AppealAnswer::findOne($ansid);
            $file = $old->file;
        }
        if($model->load(Yii::$app->request->post())){

            if($model->file = UploadedFile::getInstance($model,'file')){
                $name = microtime(true).'.'.$model->file->extension;
                $model->file->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
                $model->file = $name;
            }else{
                $model->file = $file;
            }
            if($model->save()){
                $par = AppealBajaruvchi::findOne($model->parent_id);
                $par->status = 3;
                $par->save(false);
                $register->status = 3;
                $register->detail = $model->detail;
                $register->file = $model->file;
                $register->answer_send = $model->reaply_send;
                $register->control_id = $model->n_olish;
                $register->save();
                if($ansid != 0){
                    return $this->redirect(['acceptanswer','id'=>$ansid]);
                }
                return $this->redirect(['view','id'=>$register->id]);
            }else{
                echo "<pre>";
                var_dump($model);
                exit;
            }
        }

        return $this->renderAjax('_answerform',[
            'model'=>$model
        ]);
    }

    public function actionCreate(){
        $model = new Appeal();

        $register = new AppealRegister();
        $register->preview = "Мурожаатни кўриб чиқиб, кўтарилган масалани ўрнатилган тартибда ҳал қилиб, натижаси ҳақида муаллифга жавоб хати тайёрлансин.";
        $register->deadline = 15;
        $register->date = date('Y-m-d');
        $register->company_id = Yii::$app->user->identity->company_id;
        $register->deadtime = date('Y-m-d', strtotime(date('Y-m-d'). ' + 15 days'));;
        $model->region_id = Yii::$app->user->identity->company->region_id;
        $model->count_applicant = 1;
        $model->count_list = 1;
        $model->appeal_control_id = 1;
        $model->nation_id = 1;
        $model->email = '';
        //appeal_file file upload
        //users array to json
        $model->district_id = Yii::$app->user->identity->company->district_id;

        if($model->load(Yii::$app->request->post()) and $register->load(Yii::$app->request->post())){
            $model->deadtime = $register->deadtime;
            if($model->appeal_file = UploadedFile::getInstance($model,'appeal_file')){
                $name = microtime(true).'.'.$model->appeal_file->extension;
                $model->appeal_file_extension = $model->appeal_file->extension;
                $model->appeal_file->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
                $model->appeal_file = $name;
            }
            if($model->isbusinessman == 0){
                $model->businessman = null;
            }
            if($model->boshqa_tashkilot != 1){
                $model->boshqa_tashkilot_date = null;
                $model->boshqa_tashkilot_group_id = null;
                $model->boshqa_tashkilot_id = null;
                $model->boshqa_tashkilot_number = null;
            }
            $model->upload();

            if($model->save()){

                $register->appeal_id = $model->id;
                $tashkilot = isset($register->tashkilot) ? $register->tashkilot : [];
                $register->control_id = 1;
                $register->users = json_encode($register->users);
                $register->tashkilot = json_encode($register->tashkilot);
                try {
                    $register->save();
                    $task = new TaskEmp();
                    $task->appeal_id = $model->id;
                    $task->register_id = $register->id;
                    $task->reciever_id = $register->rahbar_id;
                    $task->sender_id = $register->rahbar_id;
                    $task->deadtime = $register->deadtime;
                    $task->task = '-';
                    $task->status = 0;
                    $task->save();
                    $task = new TaskEmp();
                    $task->appeal_id = $model->id;
                    $task->register_id = $register->id;
                    $task->sender_id = $register->rahbar_id;
                    $task->reciever_id = $register->ijrochi_id;
                    $task->deadtime = $register->deadtime;
                    $task->task = '-';
                    $task->status = 0;
                    $task->save();
                    if(count($tashkilot)>0){
                        foreach ($tashkilot as $user) {
                            $baj = new AppealBajaruvchi();
                            $baj->company_id = $user;
                            $baj->appeal_id = $model->id;
                            $baj->register_id = $register->id;
                            $baj->deadtime = $register->deadtime;
                            $baj->deadline = $register->deadline;
                            $baj->letter = $model->letter;
                            $baj->save();

                            $baj = null;
                        }
                    }
                    return $this->redirect(['view','id'=>$register->id]);
                }catch (\Exception $e){
                    $bar = AppealBajaruvchi::find()->where(['appeal_id'=>$model->id])->all();
                    foreach ($bar as $it){$it->delete();}
                    $model->delete();
                }

            }else{
                echo "<pre>";
                var_dump($model);
                exit;
            }

        }
        return $this->render('create',[
            'model'=>$model,
            'register'=>$register
        ]);
    }

    public function actionRegform($id){
        $model = new AppealRegister();
        $baj = AppealBajaruvchi::findOne($id);
        if($baj->status == 0){
            $baj->status = 1;
            $baj->save(false);
        }
        $model->appeal_id = $baj->appeal_id;
        $model->parent_bajaruvchi_id = $baj->id;
        $model->company_id = $baj->company_id;
        $model->deadline = $baj->deadline;
        $model->deadtime = $baj->deadtime;
        $model->preview = $baj->register->preview;
        $model->scenario = 'reg';
        if($model->load(Yii::$app->request->post())){

            if($model->save()){

                $task = new TaskEmp();
                $task->appeal_id = $model->appeal_id;
                $task->register_id = $model->id;
                $task->reciever_id = $model->rahbar_id;
                $task->sender_id = $model->rahbar_id;
                $task->deadtime = $model->deadtime;
                $task->task = '-';
                $task->status = 0;
                $task->save();
                if($model->rahbar_id != $model->ijrochi_id){
                    $task = new TaskEmp();
                    $task->appeal_id = $model->appeal_id;
                    $task->register_id = $model->id;
                    $task->reciever_id = $model->ijrochi_id;
                    $task->sender_id = $model->rahbar_id;
                    $task->deadtime = $model->deadtime;
                    $task->task = '-';
                    $task->status = 0;
                    $task->save();
                }

                $baj->status = 2;
                $baj->save(false);

                $app = $model->appeal;
                $app->appeal_control_id = 1;
                $app->save();
                return $this->redirect(['view','id'=>$model->id]);
            }else{
                echo "<pre>";
                var_dump($model);
                exit;
            }
        }
        return $this->render('_register',[
            'reg'=>$model,
            'model'=>Appeal::findOne($baj->appeal_id),
            'register'=>AppealRegister::findOne($baj->register_id),
            'baj'=>$baj
        ]);
    }

    public function actionNotregister(){

        $searchModel = new AppealBajaruvchiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('notregister', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id){
        $register = AppealRegister::findOne($id);
        $model = Appeal::findOne($register->appeal_id);
        $oldtashkilot = isset($register->tashkilot) ? json_decode($register->tashkilot,true) : [] ;
        if($register->load(Yii::$app->request->post())){
// tashkilotlardan murojaatni o'chirish ko'nasinda yo'qini o'chirish tozalarini qo'shish
            $register->appeal_id = $model->id;
            $tashkilot = isset($register->tashkilot) ? $register->tashkilot : [];
            $register->control_id = 1;
            $register->users = isset($register->users) ? json_encode($register->users) : null;
            $register->tashkilot = isset($register->tashkilot) ? json_encode($register->tashkilot) : null;
            $register->upload();

            if($register->save()){

                if(is_array($tashkilot) and count($tashkilot) == 1 and $tashkilot[0] == "-1"){
                    $tashkilot = [];
                    $register->tashkilot = null;
                }


                if($oldtashkilot and isset($oldtashkilot) and is_array($oldtashkilot)){
                    foreach ($oldtashkilot as $item){
                        if($tashkilot and  isset($tashkilot) and is_array($tashkilot) and !in_array($item, $tashkilot)){
                            if($baj = AppealBajaruvchi::find()->where(['register_id'=>$register->id])->andWhere(['appeal_id'=>$register->appeal_id])->andWhere(['company_id'=>$item])->one()){

                                if($r = AppealRegister::findOne(['parent_bajaruvchi_id'=>$baj->id])){
                                    $r->delete();
                                }
                                $baj->delete();
                            }
                        }
                    }
                }

                if(is_array($tashkilot)) {

                    foreach ($tashkilot as $user) {
                        if ($oldtashkilot and  isset($oldtashkilot) and is_array($oldtashkilot) and !in_array($user, $oldtashkilot)) {
                            $baj = new AppealBajaruvchi();
                            $baj->company_id = $user;
                            $baj->appeal_id = $model->id;
                            $baj->register_id = $register->id;
                            $baj->deadtime = $register->deadtime;
                            $baj->deadline = $register->deadline;
                            $baj->letter = $register->letter;
                            $baj->save();
                            $baj = null;
                        } else {

                            if($baj = AppealBajaruvchi::find()->where(['company_id'=>$user])->andWhere(['register_id'=>$id])->andWhere(['appeal_id'=>$register->appeal_id])->one()){
                                $baj->company_id = $user;
                                $baj->appeal_id = $model->id;
                                $baj->register_id = $register->id;
                                $baj->deadtime = $register->deadtime;
                                $baj->deadline = $register->deadline;
                                $baj->letter = $register->letter;
                                $baj->save();

                                $baj = null;
                            }else{
                                $baj = new AppealBajaruvchi();
                                $baj->company_id = $user;
                                $baj->appeal_id = $model->id;
                                $baj->register_id = $register->id;
                                $baj->deadtime = $register->deadtime;
                                $baj->deadline = $register->deadline;
                                $baj->letter = $register->letter;
                                $baj->save();
                                $baj = null;
                            }
                        }

                    }
                }

                return $this->redirect(['view','id'=>$register->id]);
            }else{

                echo "<pre>";
                var_dump($register);
                exit;
            }
        }

        return $this->render('_update',[
            'model'=>$model,
            'register'=>$register
        ]);
    }


    public function actionDeletetask($id){

        $baj = AppealBajaruvchi::findOne($id);
        $redid = $baj->register_id;

        $reg = AppealRegister::find()->where(['parent_bajaruvchi_id'=>$baj->id])->all();
        foreach ($reg as $item){
            $item->delete();
        }
        $baj->delete();
        Yii::$app->session->setFlash('success','Топшириқ мувоффақиятли ўчирилди');
        return $this->redirect(['view','id'=>$redid]);
    }

    public function actionDeletetaskemp($sender_id,$reciever_id,$register_id){
        $model = TaskEmp::findOne(['sender_id'=>$sender_id,'reciever_id'=>$reciever_id,'register_id'=>$register_id]);
        $model->delete();
        return $this->redirect(['view','id'=>$register_id]);
    }

    public function actionShowresult($id){

        $model = AppealBajaruvchi::findOne($id);
        $register = AppealRegister::findOne($model->register_id);
        $appeal = Appeal::findOne($model->appeal_id);
        $answer = AppealAnswer::find()->where(['parent_id'=>$model->id])->orderBy(['id'=>SORT_DESC])->one();
        $appeal->scenario = 'close';
        $result = AppealRegister::findOne($answer->register_id);
        $com = new AppealComment();
        $com->answer_id = $answer->id;
        $com->status = 5;
        if($com->load(Yii::$app->request->post()) and $com->save()){
            $result->status = 5;
            $model->status = 5;
            $answer->status = 5;
            $result->save(false);
            $model->save(false);
            $answer->save(false);
            return $this->redirect(['view','id'=>$register->id]);
        }


        return $this->render('viewresult',[
            'model'=>$appeal,
            'register'=>$register,
            'bajaruvchi'=>$model,
            'result'=>$result,
            'answer'=>$answer
        ]);

    }

    public function actionViewresult($id){

        $answer = AppealAnswer::findOne($id);
        $model = AppealBajaruvchi::findOne($answer->parent_id);
        $register = AppealRegister::findOne($model->register_id);
        $appeal = Appeal::findOne($model->appeal_id);

        $result = AppealRegister::findOne($answer->register_id);
        $com = new AppealComment();
        $com->answer_id = $answer->id;
        $com->status = 5;
        if($com->load(Yii::$app->request->post()) and $com->save()){
            $result->status = 5;
            $model->status = 5;
            $answer->status = 5;
            $result->save(false);
            $model->save(false);
            $answer->save(false);
            return $this->redirect(['view','id'=>$register->id]);
        }
        $appeal->scenario = 'close';

        return $this->render('viewresult',[
            'model'=>$appeal,
            'register'=>$register,
            'bajaruvchi'=>$model,
            'result'=>$result,
            'answer'=>$answer
        ]);

    }


    public function actionAcceptanswer($id){

        $answer = AppealAnswer::findOne($id);
        $model = $answer->parent;
        $register = AppealRegister::findOne($model->register_id);

        $result = AppealRegister::findOne($answer->register_id);

        $result->status = 4;
        $model->status = 4;
        $answer->status = 4;
        closeAppeal($model->appeal_id,$result->id,$result->control_id);
        $result->save(false);
        $model->save(false);
        $answer->save(false);
        return $this->redirect(['view','id'=>$register->id]);

    }

    public function actionMerge(){
        $model = AppealRegister::find()->all();
        foreach ($model as $item){
            // rahbarga
            if($item->rahbar_id){
                $baj = new TaskEmp();
                $baj->reciever_id = $item->rahbar_id;
                $baj->sender_id = $item->rahbar_id;
                $baj->task = '-';
                $baj->deadtime = $item->deadtime;
                $baj->register_id = $item->id;
                $baj->appeal_id = $item->appeal_id;
                $baj->status = 0;
                $baj->created = $item->created;
                $baj->updated = $item->created;
                if($baj->save()){

                }
                $baj = null;
            }

            // urinbosarga
            if($item->ijrochi_id){
                $baj = new TaskEmp();
                $baj->reciever_id = $item->ijrochi_id;
                $baj->sender_id = $item->rahbar_id;
                $baj->task = '-';
                $baj->deadtime = $item->deadtime;
                $baj->register_id = $item->id;
                $baj->appeal_id = $item->appeal_id;
                $baj->status = 0;
                $baj->created = $item->created;
                $baj->updated = $item->created;
                if($baj->save()){

                }
                $baj = null;
            }
            $users = json_decode($item->users,true);
            if(is_array($users)){
                foreach ($users as $us){
                    if($us != $item->ijrochi_id and $us != $item->rahbar_id){
                        $baj = new TaskEmp();
                        $baj->reciever_id = $us;
                        $baj->sender_id = $item->rahbar_id;
                        $baj->task = '-';
                        $baj->deadtime = $item->deadtime;
                        $baj->register_id = $item->id;
                        $baj->appeal_id = $item->appeal_id;
                        $baj->status = 0;
                        $baj->created = $item->created;
                        $baj->updated = $item->created;
                        if($baj->save()){

                        }
                        $baj = null;
                    }

                }
            }
        }
        return $this->redirect(['index']);
    }


    public function actionAcceptrequest($id){
        $model = Request::findOne($id);
        if($model->type_id == 1){
            changeTime($id);
        }else{
            changeCompany($id);
        }
        return $this->redirect(['request']);
    }


    public function actionRequest($do=null,$all=null){
        $searchModel = new RequestSearch();
        if($do){
            $searchModel->do = $do;
        }
        if($all){
            $searchModel->sts = 1;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('request', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewrequest($id){

        $request = Request::findOne($id);
        if($request->status_id == 0){
            $request->status_id = 1;
            $request->save();
        }
        if($request->sender->company_id == Yii::$app->user->identity->company_id){
            $model = TaskEmp::find()
                ->where(['register_id'=>$request->register_id])
                ->andWhere(['appeal_id'=>$request->appeal_id])
                ->andWhere(['reciever_id'=>$request->sender_id])->one();
            $type = 1;
        }else{
            $model = AppealBajaruvchi::findOne($request->register->parent_bajaruvchi_id);
            $type = 2;
        }

        $register = AppealRegister::findOne($model->register_id);
        $appeal = Appeal::findOne($model->appeal_id);


        $appeal->scenario = 'close';

        return $this->render('viewrequest',[
            'model'=>$appeal,
            'register'=>$register,
            'bajaruvchi'=>$model,
            'request'=>$request,
            'type'=>$type
        ]);

    }


    public function actionTohok(){
        $model = new Appeal();
        $model->company_id = 1;
        $model->register_id = Yii::$app->user->id;
        $model->register_company_id = Yii::$app->user->identity->company_id;
        $model->type = 1;
        $model->count_applicant = 1;
        $model->count_list = 1;
        $com = Yii::$app->user->identity->company;
        $model->region_id = $com->region_id;
        $model->district_id = $com->district_id;
        $model->village_id = $com->village_id;
        $model->deadtime = date('Y-m-d', strtotime(date('Y-m-d') . ' +15 day'));

        if($model->load(Yii::$app->request->post())){
            if($model->appeal_file = UploadedFile::getInstance($model,'appeal_file')){
                $name = microtime(true).'.'.$model->appeal_file->extension;
                $model->appeal_file->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
                $model->appeal_file = $name;
            }
            $model->year = date('Y');
            if($model->number = Appeal::find()->where(['year'=>$model->year])->andWhere(['type'=>1])->max('number')){
                $model->number = $model->number+1;
            }else{
                $model->number = 1;
            }

            $model->number_full = $model->number.'/'.substr($model->year,2,2);

            if($model->save()){
                Yii::$app->session->setFlash('success','Мурожаат Хоразм вилоят ҳокимлигига мувоффақиятли юборилди.');
                return $this->redirect(['viewhok','id'=>$model->id]);
            }
        }
        return $this->render('tohok',[
            'model'=>$model
        ]);
    }

    public function actionViewhok($id){
        $model = Appeal::findOne($id);
        if($model->status==0){
            $model->status=1;
            $model->save();
        }
        $register = new AppealRegister();
        $register->scenario = 'reg';
        $register->preview = "Мурожаатни кўриб чиқиб, кўтарилган масалани ўрнатилган тартибда ҳал қилиб, натижаси ҳақида муаллифга жавоб хати тайёрлансин.";
        $register->masala = $model->appeal_detail;
        $register->number = $model->number_full;
        $register->date = date('Y-m-d');
        if($register->load(Yii::$app->request->post())){
            $register->appeal_id = $model->id;
            $register->deadtime = $model->deadtime;
            $register->deadline = 15;
            $register->status = 2;
            $register->company_id = $model->company_id;
            if($register->save()){
                $model->question_id = $register->question_id;
                $model->appeal_control_id = 1;
                $model->status = 2;
                $model->appeal_detail = $register->masala;
                $model->save();
                return $this->redirect(['view','id'=>$register->id]);
            }
        }


        return $this->render('viewhok',[
            'model'=>$model,
            'register'=>$register
        ]);
    }

    public function actionIndexhok(){
        $searchModel = new AppealSearch();
        $dataProvider = $searchModel->searchVillage(Yii::$app->request->queryParams);

        return $this->render('indexhok', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionIndexhokall(){
        $searchModel = new AppealSearch();
        $dataProvider = $searchModel->searchVillages(Yii::$app->request->queryParams);

        return $this->render('indexhok', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNotregvil(){
        $searchModel = new AppealSearch();
        $dataProvider = $searchModel->searchNotreg(Yii::$app->request->queryParams);

        return $this->render('indexhok', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionTosayyor(){
        $model = new Appeal();
//        $model->scenario = "insert";
        $register = new AppealRegister();
//        $register->scenario = 'sayyor';

        $model->company_id = Yii::$app->user->identity->company_id;
        $model->register_id = Yii::$app->user->id;
        $model->register_company_id = Yii::$app->user->identity->company_id;
        $model->type = 2;
        $model->count_applicant = 1;
        $model->count_list = 1;
        $model->appeal_shakl_id = 5;
        $model->appeal_type_id = 1;
        $model->appeal_control_id = 1;
        $com = Yii::$app->user->identity->company;
        $model->region_id = $com->region_id;
        $model->district_id = $com->district_id;
        $model->village_id = $com->village_id;
        $model->deadtime = date('Y-m-d', strtotime(date('Y-m-d') . ' +10 day'));
        $register->preview = "Мурожаатни кўриб чиқиб, кўтарилган масалани ўрнатилган тартибда ҳал қилиб, натижаси ҳақида муаллифга жавоб хати тайёрлансин.";

        if($model->load(Yii::$app->request->post()) and $register->load(Yii::$app->request->post())){

            if($model->appeal_file = UploadedFile::getInstance($model,'appeal_file')){
                $name = microtime(true).'.'.$model->appeal_file->extension;
                $model->appeal_file->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
                $model->appeal_file = $name;
            }
            $model->year = date('Y');
            if($model->number = Appeal::find()->where(['year'=>$model->year])->andWhere(['company_id'=>Yii::$app->user->identity->company_id])->andWhere(['type'=>'2'])->max('number')){
                $model->number = $model->number+1;
            }else{
                $model->number = 1;
            }
            $model->question_id = $register->question_id;
            $model->number_full = "S-".$model->number.'-'.substr($model->year,2,2).'/'.Yii::$app->user->identity->company_id;

            if($model->save()){
//                $register->masala = $model->appeal_detail;
                $register->number = $model->number_full;
                $register->date = date('Y-m-d');
                $register->deadtime = $model->deadtime;
                $register->appeal_id = $model->id;
                $register->deadtime = $model->deadtime;
                $register->deadline = 10;
                $register->status = 2;
                $register->company_id = $model->company_id;
                if($register->save()){
                    $model->question_id = $register->question_id;
                    $model->appeal_control_id = 1;
                    $model->status = 2;
                    $model->save();

                    $task = new TaskEmp();
                    $task->appeal_id = $model->id;
                    $task->register_id = $register->id;
                    $task->reciever_id = $register->rahbar_id;
                    $task->sender_id = $register->rahbar_id;
                    $task->deadtime = $register->deadtime;
                    $task->task = '-';
                    $task->status = 0;
                    $task->save();
                    if($register->rahbar_id != $register->ijrochi_id){
                        $task = new TaskEmp();
                        $task->appeal_id = $model->id;
                        $task->register_id = $register->id;
                        $task->sender_id = $register->rahbar_id;
                        $task->reciever_id = $register->ijrochi_id;
                        $task->deadtime = $register->deadtime;
                        $task->task = '-';
                        $task->status = 0;
                        $task->save();
                    }


                    Yii::$app->session->setFlash('success','Мурожаат мувоффақиятли қибул қилинди.');
                    return $this->redirect(['view','id'=>$register->id]);
                }
            }
        }
        return $this->render('tosayyor',[
            'model'=>$model,
            'register'=>$register
        ]);
    }


}
