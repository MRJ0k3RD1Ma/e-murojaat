<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appeal_boshqa_tashkilot_group".
 *
 * @property int $id
 * @property string $name
 */
class AppealBoshqaTashkilotGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_boshqa_tashkilot_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
        ];
    }
    public function getTashkilotlar(){
        return $this->hasMany(AppealBoshqaTashkilot::className(),['group_id'=>'id']);
    }
}
