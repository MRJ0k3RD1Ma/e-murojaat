<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loc_village".
 *
 * @property int $id
 * @property string $name Маҳалла
 * @property int $region_id
 * @property int $district_id Туман (шахар)
 * @property string|null $svg_map
 * @property string|null $jpg_map Туман ҳаритаси
 * @property int $sort
 *
 * @property District $district
 * @property Region $region
 */
class Village extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loc_village';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'region_id', 'district_id'], 'required'],
            [['region_id', 'district_id', 'sort'], 'integer'],
            [['svg_map'], 'string'],
            [['name', 'jpg_map'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Маҳалла',
            'region_id' => 'Region ID',
            'district_id' => 'Туман (шахар)',
            'svg_map' => 'Svg Map',
            'jpg_map' => 'Туман ҳаритаси',
            'sort' => 'Sort',
        ];
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }
    public function getAppeal(){
        return $this->hasMany(Appeal::className(),['village_id'=>'id']);
    }
}
