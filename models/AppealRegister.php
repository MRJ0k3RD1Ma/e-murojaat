<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "appeal_register".
 *
 * @property int $id
 * @property string $number
 * @property string $date
 * @property int $appeal_id
 * @property int $ijrochi_id
 * @property string|null $users
 * @property int|null $parent_bajaruvchi_id
 * @property int $deadline
 * @property string $deadtime
 * @property string $donetime
 * @property int $control_id
 * @property int $status
 * @property int $user_answer
 * @property int $tashkilot_answer
 * @property int $tashkilot
 * @property int $question_id
 * @property string $created
 * @property string $updated
 * @property string|null $preview
 * @property string|null $detail
 * @property string|null $file
 * @property int|null $company_id
 * @property int|null $answer_send
 */
class AppealRegister extends \yii\db\ActiveRecord
{
    public $letter,$mystatus,$masala;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_register';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['number', 'date', 'appeal_id',], 'required'],
            [['number','date','rahbar_id','preview','ijrochi_id'],'required','on'=>'reg'],
            [['rahbar_id','preview','ijrochi_id'],'required','on'=>'sayyor'],
            [['date', 'question_id','deadtime', 'donetime', 'created', 'updated','takroriy_date'], 'safe'],
            [['appeal_id', 'ijrochi_id','rahbar_id', 'parent_bajaruvchi_id','nazorat', 'takroriy','takroriy_id','deadline', 'control_id', 'status', 'company_id', 'answer_send'], 'integer'],
            [['users', 'detail','user_answer','masala','user_answer','tashkilot','tashkilot_answer'], 'string'],
            [['number', 'preview', 'file','takroriy_number'], 'string', 'max' => 255],
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
            'number' => 'Рақами',
            'date' => 'Сана',
            'appeal_id' => 'Мурожаат',
            'ijrochi_id' => 'Масъул',
            'rahbar_id' => 'Раҳбар',
            'users' => 'Бажарувчилар',
            'parent_bajaruvchi_id' => 'Топшириқ',
            'deadline' => 'Муддат(кун)',
            'deadtime' => 'Муддат',
            'donetime' => 'Ёпилган сана',
            'control_id' => 'Назоратлилиги',
            'status' => 'Статус',
            'users_answer' => 'Ҳодимлар жавоби',
            'tashkilot_answer' => 'Ташкилотлар жавоби',
            'tashkilot' => 'Бажарувчи ташкилотлар',
            'created' => 'Яратилди',
            'updated' => 'Ўзгартирилди',
            'preview' => 'Раҳбар резолюцияси',
            'detail' => 'Detail',
            'file' => 'File',
            'company_id' => 'Company ID',
            'answer_send' => 'Answer Send',
            'letter'=>'Кузатувчи хат',
            'question_id'=>'Масаласи',
            'masala'=>'Мурожаат матни',
        ];
    }
    public function getQuestion(){
        return $this->hasOne(AppealQuestion::className(),['id'=>'question_id']);
    }
    public function getAppeal(){
        return $this->hasOne(Appeal::className(),['id'=>'appeal_id']);
    }
    public function getRahbar(){
        return $this->hasOne(User::className(),['id'=>'rahbar_id']);
    }
    public function getIjrochi(){
        return $this->hasOne(User::className(),['id'=>'ijrochi_id']);
    }
    public function getControl(){
        return $this->hasOne(AppealControl::className(),['id'=>'control_id']);
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

    public function getParent(){
        return $this->hasOne(AppealBajaruvchi::className(),['id'=>'parent_bajaruvchi_id']);
    }

    public function getMyrequest(){
        return $this->hasMany(Request::className(),['register_id'=>'id']);
    }

    public function getChild(){
        return $this->hasMany(AppealBajaruvchi::className(),['register_id'=>'id']);
    }
    public function getAnswer(){
        return $this->hasMany(AppealAnswer::className(),['register_id'=>'id']);
    }
    public function getChildanswer(){
        return AppealAnswer::find()
            ->where('parent_id in (select id from appeal_bajaruvchi where register_id='.$this->id.')')
            ->orderBy(['id'=>SORT_DESC])->all();
    }
    public function getChildanswermy(){
        return AppealAnswer::find()
            ->where('parent_id in (select id from appeal_bajaruvchi where register_id='.$this->id.' and sender_id='.Yii::$app->user->id.')')
            ->orderBy(['id'=>SORT_DESC])->all();
    }


    public function getStatus0(){
        return $this->hasOne(Status::className(),['id'=>'status']);
    }

    public function getChildemp(){
        return $this->hasMany(TaskEmp::className(),['register_id'=>'id'])->orderBy(['created'=>SORT_DESC]);
    }
}
