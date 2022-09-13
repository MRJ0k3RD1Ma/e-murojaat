<?php

namespace app\models;

use Symfony\Component\Console\Question\Question;
use Yii;

/**
 * This is the model class for table "appeal_question_group".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 */
class AppealQuestionGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_question_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код',
            'name' => 'Номи',
        ];
    }
    public function getQuestion(){
        return $this->hasMany(AppealQuestion::className(),['group_id'=>'id']);
    }
}
