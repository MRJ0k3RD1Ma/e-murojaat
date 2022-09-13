<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company_type".
 *
 * @property int $id
 * @property string $name
 * @property int $group_id
 */
class CompanyType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'group_id'], 'required'],
            [['group_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Номи',
            'group_id' => 'Гуруҳ',
        ];
    }
    public function getGroup(){
        return $this->hasOne(CompanyGroup::className(),['id'=>'group_id']);
    }
}
