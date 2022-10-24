<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_lots".
 *
 * @property int $id
 * @property string $lot_number
 * @property string|null $ads
 * @property int $service_id
 * @property int $status
 * @property string $exp_date
 *
 * @property Service $service
 */
class ServiceLots extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_lots';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id'], 'required'],
            [['service_id', 'status'], 'integer'],
            ['exp_date','safe'],
            [['lot_number', 'ads'], 'string', 'max' => 255],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lot_number' => 'Lot raqami',
            'ads' => 'Izoh',
            'service_id' => 'Xizmat',
            'exp_date' => 'Muddat',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
