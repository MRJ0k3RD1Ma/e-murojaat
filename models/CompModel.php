<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CompModel extends Model
{
    public $name,$username,$password,$region,$district,$cnt;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name','username','password'], 'required'],
            [['region','district','cnt'],'integer'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Ташкилот номи',
            'username' => 'Логин',
            'password' => 'Парол',
        ];
    }

    public function getCode($id){
        $codes = [
            1=>'urganch',
            2=>'bogot',
            3=>'gurlan',
            4=>'qushkupir',
            5=>'hazorasp',
            6=>'xiva',
            7=>'xonqa',
            8=>'shovot',
            9=>'yangiariq',
            10=>'yangibozor',
            11=>'urganchsh',
            199=>'tuproqqala',
            200=>'xivash',
        ];
        return $codes[$id];
    }
}
