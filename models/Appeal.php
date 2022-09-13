<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "rest".
 *
 * @property int $id
 * @property int $pursuit
 * @property string|null $passport
 * @property string|null $passport_jshshir
 * @property int|null $person_id
 * @property string $person_name
 * @property string $person_phone
 * @property string|null $date_of_birth
 * @property string|null $specialization
 * @property string|null $job
 * @property string|null $work_place
 * @property int $gender
 * @property int $nation_id
 * @property int|null $home_id
 * @property string|null $types
 * @property string|null $detail
 * @property int $region_id
 * @property int $district_id
 * @property int $village_id
 * @property int $count_list
 * @property int $count_applicant
 * @property string $address
 * @property string|null $email
 * @property string|null $businessman
 * @property string $appeal_preview
 * @property string $appeal_detail
 * @property string|null $appeal_file
 * @property int|null $question_id
 * @property string|null $executor_files
 * @property string|null $appeal_file_extension
 * @property int $appeal_type_id
 * @property int|null $appeal_shakl_id
 * @property int $appeal_control_id
 * @property int $status
 * @property int $company_id
 * @property int $boshqa_tashkilot
 * @property int $boshqa_tashkilot_id
 * @property int $boshqa_tashkilot_group_id
 * @property string $boshqa_tashkilot_date
 * @property string $boshqa_tashkilot_number
 * @property string $created
 * @property string $updated
 * @property string $answer_name
 * @property string $answer_file
 * @property string $answer_number
 * @property integer $answer_reply_send
 * @property integer $answer_detail
 * @property integer $answer_preview
 * @property integer $letter
 * @property integer $register_id
 * @property integer $register_company_id
 * @property integer $type
 */
class Appeal extends \yii\db\ActiveRecord
{
    public $letter;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pursuit', 'person_id','number','year', 'gender','type','register_id','register_company_id', 'nation_id', 'home_id','count_list','count_applicant','answer_reply_send','company_id', 'region_id','boshqa_tashkilot', 'boshqa_tashkilot_group_id','isbusinessman','boshqa_tashkilot_id','district_id', 'village_id', 'question_id', 'appeal_type_id', 'appeal_shakl_id', 'appeal_control_id', 'status'], 'integer'],
            [['region_id', 'district_id', 'address','gender', 'appeal_detail', 'appeal_type_id',], 'required','on'=>'insert'],
            [['answer_name','answer_preview','answer_number','appeal_control_id','answer_date',],'required','on'=>'close'],
            [['date_of_birth', 'created', 'updated','boshqa_tashkilot_date','answer_date','deadtime'], 'safe'],
            [['types', 'detail', 'appeal_preview','answer_detail','appeal_detail', 'executor_files'], 'string'],
            [['answer_name','answer_file','number_full','answer_preview','answer_number','boshqa_tashkilot_number','passport', 'passport_jshshir', 'person_name', 'person_phone', 'specialization', 'job', 'work_place', 'address', 'email', 'appeal_file', 'appeal_file_extension'], 'string', 'max' => 255],
            [['businessman',], 'string', 'max' => 500],
            [['register_id'],'default','value'=>Yii::$app->user->id],
            [['register_company_id'],'default','value'=>Yii::$app->user->identity->company_id],
            ['company_id','default','value'=>Yii::$app->user->identity->company_id],
            ['letter','file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pursuit' => 'Тақиб ҳақида огоҳлантириш',
            'passport' => 'Паспорт серия рақами',
            'passport_jshshir' => 'ЖШШИР',
            'person_id' => 'Person ID',
            'person_name' => 'ФИО',
            'person_phone' => 'Телефон рақами',
            'date_of_birth' => 'Туғилган санаси',
            'specialization' => 'Диплом бўйича мутахассислиги',
            'job' => 'Касби(ҳунари)',
            'work_place' => 'Иш жойи ва лавозими',
            'gender' => 'Жинси',
            'company_id' => 'Ташкилот',
            'nation_id' => 'Миллати',
            'home_id' => 'Уй',
            'types' => 'Кўрсаткичлар',
            'isbusinessman' => 'Юридик шахс',
            'detail' => 'Батафсил',
            'region_id' => 'Вилоят',
            'district_id' => 'Туман',
            'village_id' => 'Маҳалла',
            'address' => 'Манзил',
            'email' => 'Эл-почта',
            'businessman' => 'Тадбиркорлик субьекти номи',
            'appeal_preview' => 'Раҳбар резолюцияси',
            'appeal_detail' => 'Мурожаатнинг матни',
            'appeal_file' => 'Мурожаат файли',
            'question_id' => 'Савол',
            'executor_files' => 'Жавоб файли',
            'appeal_file_extension' => 'Жавоб файл кенгайтмаси',
            'appeal_type_id' => 'Мурожаат тури',
            'appeal_shakl_id' => 'Мурожаат шакли',
            'appeal_control_id' => 'Назорат',
            'count_applicant' => 'Мурожаатчилар сони',
            'count_list' => 'Вароқлар сони',
            'status' => 'Статус',
            'created' => 'Мурожаат келган сана',
            'updated' => 'Ўзгартирилди',
            'boshqa_tashkilot_date'=>'Санаси',
            'boshqa_tashkilot_number'=>'Рақами',
            'boshqa_tashkilot_id'=>'Ташкилот',
            'boshqa_tashkilot_group_id'=>'Ташкилот гуруҳи',
            'boshqa_tashkilot'=>'Бошқа ташкилот',
            'letter'=>'Кузатувчи хат',
            'answer_file'=>'Файл',
            'answer_name'=>'Ижрочи',
            'answer_detail'=>'Мазмуни',
            'answer_reply_send'=>'Жавоб мурожаатчига юборилди',
            'answer_date'=>'Санаси',
            'answer_number'=>'Рақами',
            'answer_preview'=>'Ҳужжат номи',
            'number_full'=>'Мурожаат рақами',
            'deadtime'=>'Муддат',
        ];
    }
    public function getRegister(){
        return $this->hasMany(AppealRegister::className(),['appeal_id'=>'id']);
    }
    public function getQuestion(){
        return $this->hasOne(AppealQuestion::className(),['id'=>'question_id']);
    }
    public function getRegion(){
        return $this->hasOne(Region::className(),['id'=>'region_id']);
    }
    public function getDistrict(){
        return $this->hasOne(District::className(),['id'=>'district_id']);
    }
    public function getVillage(){
        return $this->hasOne(Village::className(),['id'=>'village_id']);
    }
    public function getNation(){
        return $this->hasOne(Nation::className(),['id'=>'nation_id']);
    }
    public function getBoshqaTashkilot(){
        return $this->hasOne(AppealBoshqaTashkilot::className(),['id'=>'boshqa_tashkilot_id']);
    }
    public function getAppealShakl(){
        return $this->hasOne(AppealShakl::className(),['id'=>'appeal_shakl_id']);
    }
    public function getAppealType(){
        return $this->hasOne(AppealType::className(),['id'=>'appeal_type_id']);
    }
    public function getAppealControl(){
        return $this->hasOne(AppealControl::className(),['id'=>'appeal_control_id']);
    }
    public function getCompany(){
        return $this->hasOne(Company::className(),['id'=>'company_id']);
    }
    public function upload(){
        if($this->letter = UploadedFile::getInstance($this,'letter')){
            $name = microtime(true).'.'.$this->letter->extension;
            $this->letter->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
            $this->letter = $name;
        }
    }
    public function uploadAppeal(){
        if($this->appeal_file = UploadedFile::getInstance($this,'appeal_file')){
            $name = microtime(true).'.'.$this->appeal_file->extension;
            $this->appeal_file->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
            $this->appeal_file = $name;
        }
    }
    public function getStatus0(){
        return $this->hasOne(Status::className(),['id'=>'status']);
    }
}
