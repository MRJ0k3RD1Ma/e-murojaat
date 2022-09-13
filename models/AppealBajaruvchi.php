<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "appeal_bajaruvchi".
 *
 * @property int $id
 * @property int $company_id
 * @property int $appeal_id
 * @property int $register_id
 * @property int $sender_id
 * @property int $deadline
 * @property int $status
 * @property string $deadtime
 * @property string $created
 * @property string $letter
 */
class AppealBajaruvchi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_bajaruvchi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deadtime','task','sender_id',], 'required'],
            [['company_id','sender_id', 'appeal_id', 'register_id', 'deadline','status'], 'integer'],
            [['deadtime','created','updated'], 'safe'],
            ['letter','string'],
            ['task','string','max'=>255],
            ['letter','required','on'=>'send'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Ташкилот',
            'appeal_id' => 'Мурожаат',
            'register_id' => 'Регистратция',
            'deadline' => 'Муддат(кун)',
            'deadtime' => 'Муддат(Сана)',
            'status' => 'Ҳолат',
            'letter' => 'Кузатув хати (виза)',
            'created' => 'Юборилган вақти',
            'task' => 'Топшириқ матни',
            'sender_id' => 'Юборувчи',
        ];
    }

    public function getCompany(){
        return $this->hasOne(Company::className(),['id'=>'company_id']);
    }
    public function getAppeal(){
        return $this->hasOne(Appeal::className(),['id'=>'appeal_id']);
    }
    public function getRegister(){
        return $this->hasOne(AppealRegister::className(),['id'=>'register_id']);
    }
    public function getChild(){
        return $this->hasOne(AppealRegister::className(),['parent_bajaruvchi_id'=>'id']);
    }
    public function upload(){
        if($this->letter = UploadedFile::getInstance($this,'letter')){
            $name = microtime(true).'.'.$this->letter->extension;
            $this->letter->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
            $this->letter = $name;
        }
    }

    public function getSender(){
        return $this->hasOne(User::className(),['id'=>'sender_id']);
    }
    public function getStatus0(){
        return $this->hasOne(Status::className(),['id'=>'status']);
    }
}
