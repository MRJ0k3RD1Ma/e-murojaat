<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company_contact".
 *
 * @property int $company_id
 * @property string $name
 * @property string $ads
 * @property string $phone
 * @property string $created
 */
class CompanyContact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'name', 'ads', 'phone'], 'required'],
            [['company_id'], 'integer'],
            [['ads'], 'string'],
            [['created'], 'safe'],
            [['name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'Company ID',
            'name' => 'Name',
            'ads' => 'Ads',
            'phone' => 'Phone',
            'created' => 'Created',
        ];
    }
}
