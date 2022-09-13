<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appeal_question".
 *
 * @property int $id
 * @property int $group_id
 * @property string $code
 * @property string $name
 */
class AppealQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'code', 'name'], 'required'],
            [['group_id'], 'integer'],
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
            'group_id' => 'Гуруҳ номи',
            'code' => 'Нод',
            'name' => 'Савол',
        ];
    }
    public function getGroup(){
        return $this->hasOne(AppealQuestionGroup::className(),['id'=>'group_id']);
    }
}
