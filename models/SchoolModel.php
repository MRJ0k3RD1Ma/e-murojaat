<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class SchoolModel extends Model
{
    public $name,$username,$password,$district,$count,$region;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name','username','password','district','count','region'], 'required'],
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
            'district' => 'Tuman',
            'count' => 'Soni',
            'region' => 'Viloyat',
        ];
    }

}
