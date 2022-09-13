<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_ignore".
 *
 * @property int $id
 * @property int $request_id
 * @property string|null $detail
 * @property int $status_id
 */
class RequestIgnore extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_ignore';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'status_id'], 'required'],
            [['request_id', 'status_id'], 'integer'],
            [['detail'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_id' => 'Request ID',
            'detail' => 'Detail',
            'status_id' => 'Status ID',
        ];
    }
}
