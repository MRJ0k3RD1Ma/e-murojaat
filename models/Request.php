<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $sender_id
 * @property int $reciever_id
 * @property int $type_id
 * @property int $register_id
 * @property int $appeal_id
 * @property int $status_id
 * @property string|null $detail
 * @property string|null $date
 * @property string|null $file
 * @property string $created
 * @property string $updated
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detail','sender_id', 'reciever_id', 'type_id', 'register_id', 'appeal_id', 'status_id'], 'required'],
            [['date'], 'required','on'=>'change'],
            [['sender_id', 'reciever_id', 'type_id', 'register_id', 'appeal_id', 'status_id'], 'integer'],
            [['detail'], 'string'],
            [['date', 'created', 'updated'], 'safe'],
            [['file'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender_id' => 'Юборувчи',
            'reciever_id' => 'Қабул қилувчи',
            'type_id' => 'Тури',
            'register_id' => 'Мурожаат рақами',
            'appeal_id' => 'Ариза рақами',
            'status_id' => 'Status',
            'detail' => 'Батафсил',
            'date' => 'Қайси санагача',
            'file' => 'Файл',
            'created' => 'Юборилган вақт',
            'updated' => 'Ўзгартирилган вақт',
        ];
    }
    public function getSender(){
        return $this->hasOne(User::className(),['id'=>'sender_id']);
    }
    public function getReciever(){
        return $this->hasOne(User::className(),['id'=>'reciever_id']);
    }
    public function getType(){
        return $this->hasOne(RequestType::className(),['id'=>'type_id']);
    }
    public function getRegister(){
        return $this->hasOne(AppealRegister::className(),['id'=>'register_id']);
    }
    public function getAppeal(){
        return $this->hasOne(Appeal::className(),['id'=>'appeal_id']);
    }
    public function getStatus(){
        return $this->hasOne(RequestStatus::className(),['id'=>'status_id']);
    }
}
