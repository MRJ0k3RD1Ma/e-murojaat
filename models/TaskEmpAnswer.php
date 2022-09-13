<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_emp_answer".
 *
 * @property int $task_id
 * @property string $preview
 * @property string|null $file
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $status
 */
class TaskEmpAnswer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_emp_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created', 'updated'], 'safe'],
            [['status'], 'integer'],
            [['preview'], 'string', 'max' => 500],
            [['file'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Топшириқ',
            'preview' => 'Мазмуни',
            'file' => 'Илова файли',
            'created' => 'Юборилди',
            'updated' => 'Охирги ўзгариш',
            'status' => 'Ҳолат',
        ];
    }

    public function getTask(){
        return $this->hasOne(TaskEmp::className(),['id'=>'task_id']);
    }
}
