<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appeal_comment".
 *
 * @property int $id
 * @property int $answer_id
 * @property string $comment
 * @property int $status
 */
class AppealComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['answer_id', 'comment','status'], 'required'],
            [['answer_id', 'status'], 'integer'],
            [['comment'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'answer_id' => 'Answer ID',
            'comment' => 'Comment',
            'status' => 'Status',
        ];
    }
}
