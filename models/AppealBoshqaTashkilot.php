<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appeal_boshqa_tashkilot".
 *
 * @property int $id
 * @property string $name
 * @property int $group_id
 * @property int $isdelete
 */
class AppealBoshqaTashkilot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_boshqa_tashkilot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'group_id'], 'required'],
            [['group_id', 'isdelete'], 'integer'],
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
            'group_id' => 'Гуруҳи',
            'isdelete' => 'Ўчирилган',
        ];
    }
    public function getGroup(){
        return $this->hasOne(AppealBoshqaTashkilotGroup::className(),['id'=>'group_id']);
    }
}
