<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loc_district".
 *
 * @property int $id
 * @property int $region_id Вилоят
 * @property string $name Туман (шахар)

 * @property int $sort

 */
class District extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loc_district';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'name'], 'required'],
            [['region_id', 'sort'], 'integer'],
            [['svg_map'], 'string'],
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
            'region_id' => 'Вилоят',
            'name' => 'Туман (шахар)',
            'svg_map' => 'Svg Map',
            'sort' => 'Sort',
        ];
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

    /**
     * Gets query for [[LocVillages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocVillages()
    {
        return $this->hasMany(Village::className(), ['district_id' => 'id']);
    }
}
