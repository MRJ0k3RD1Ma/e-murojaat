<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "task_emp".
 *
 * @property int $sender_id
 * @property int $reciever_id
 * @property int $register_id
 * @property int $appeal_id
 * @property string $deadtime
 * @property string $task
 * @property string|null $letter
 * @property string $created
 * @property string $updated
 * @property int $status
 */
class TaskEmp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_emp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sender_id', 'reciever_id', 'register_id', 'appeal_id', 'deadtime', 'task'], 'required'],
            [['sender_id', 'reciever_id', 'register_id', 'appeal_id', 'status'], 'integer'],
            [['deadtime', 'created', 'updated'], 'safe'],
            [['task'], 'string'],
            [['letter'], 'string', 'max' => 255],
            [['sender_id', 'reciever_id', 'register_id', 'appeal_id'], 'unique', 'targetAttribute' => ['sender_id', 'reciever_id', 'register_id', 'appeal_id']],
        ];
    }


    public function attributeLabels()
    {
        return [
            'sender_id' => 'Жўнатувчи',
            'reciever_id' => 'Қабул қилувчи',
            'register_id' => 'Register ID',
            'appeal_id' => 'Appeal ID',
            'deadtime' => 'Муддат',
            'task' => 'Топшириқ матни',
            'letter' => 'Файл',
            'created' => 'Юборилди',
            'updated' => 'Қабул қилинди',
            'status' => 'Статус',
        ];
    }
    public function getReciever(){
        return $this->hasOne(User::className(),['id'=>'reciever_id']);
    }
    public function getSender(){
        return $this->hasOne(User::className(),['id'=>'sender_id']);
    }
    public function getAppeal(){
        return $this->hasOne(Appeal::className(),['id'=>'appeal_id']);
    }
    public function getRegister(){
        return $this->hasOne(AppealRegister::className(),['id'=>'register_id']);
    }
    public function upload(){
        if($this->letter = UploadedFile::getInstance($this,'letter')){
            $name = microtime(true).'.'.$this->letter->extension;
            $this->letter->saveAs(Yii::$app->basePath.'/web/upload/'.$name);
            $this->letter = $name;
        }
    }

    public function getStatus0(){
        return $this->hasOne(Status::className(),['id'=>'status']);
    }
}
