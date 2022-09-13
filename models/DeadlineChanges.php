<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deadline_changes".
 *
 * @property int $id
 * @property string $comment
 * @property string $file
 * @property int $appeal_id
 * @property int $register_id
 * @property string $deadline
 * @property int $status_id
 * @property string|null $ads
 * @property string $created
 * @property string $updated
 */
class DeadlineChanges extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deadline_changes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment', 'file', 'appeal_id', 'register_id', 'deadline'], 'required'],
            [['appeal_id', 'register_id', 'status_id'], 'integer'],
            [['deadline', 'created', 'updated'], 'safe'],
            [['comment'], 'string', 'max' => 500],
            [['file', 'ads'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment' => 'Сабаб',
            'file' => 'Илова файли',
            'appeal_id' => 'Муроаат рақами',
            'register_id' => 'Рўйхатга олинган рақам',
            'deadline' => 'Муддат',
            'status_id' => 'Ҳолат',
            'ads' => 'Изоҳ',
            'created' => 'Юборилган',
            'updated' => 'Ўзгартирилган',
        ];
    }

    public function getStatus(){
        return $this->hasOne(DeadlineStatus::className(),['id'=>'status_id']);
    }

    public function getAppeal(){
        return $this->hasOne(Appeal::className(),['id'=>'appeal_id']);
    }
    public function getRegister(){
        return $this->hasOne(AppealRegister::className(),['id'=>'register_id']);
    }
}
