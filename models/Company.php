<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $inn
 * @property string $password
 * @property string $name
 * @property string $director
 * @property string $phone
 * @property string $telegram
 * @property string $active_to
 * @property string $active_each
 * @property string $created
 * @property string $updated
 * @property int $status
 * @property int $parent_id
 * @property int $type_id
 * @property int $group_id
 * @property int $management
 * @property int $region_id
 * @property int $district_id
 * @property int $village_id
 * @property string $address
 * @property string $token
 */
class Company extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $cntall,$cntzero,$cntone,$cnttwo,$cnttree,$cntfour,$cntdead,$cntwithdead,$cnt0,$cnt1,$cnt2,$cnt3,$cnt4,$cnt5,$redirect;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inn', 'password', 'name', 'director', 'phone',  'region_id', 'district_id', 'village_id', 'address','type_id','group_id'], 'required'],
            [['active_to', 'active_each', 'created', 'updated','paid_date'], 'safe'],
            [['phone','paid_date','paid'],'required','on'=>'paidtime'],
            [['status', 'parent_id','management', 'region_id', 'district_id', 'village_id','type_id','group_id','paid'], 'integer'],
            [['inn', 'name', 'director', 'phone', 'telegram', 'address','token'], 'string', 'max' => 255],
            [['password','redirect'], 'string', 'max' => 500],
            [['inn'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inn' => 'СТИР(ИНН)',
            'password' => 'Пароль',
            'type_id' => 'Ташкилот тури',
            'group_id' => 'Ташкилот гуруҳи',
            'name' => 'Ташкилот номи',
            'director' => 'Директор',
            'phone' => 'Телефон',
            'telegram' => 'Телеграм',
            'active_to' => 'Актив дан..',
            'active_each' => 'Актив ..гача',
            'created' => 'Яратилди',
            'updated' => 'Сўнги ўзгариш',
            'status' => 'Статус',
            'management' => 'Бошқарув',
            'region_id' => 'Вилоят',
            'district_id' => 'Туман',
            'village_id' => 'Маҳалла',
            'address' => 'Манзил',
            'paid' => 'Тўлов',
            'parent_id' => 'Юқори турувчи',
            'cntall' => 'Юборилган мурожаатлар',
            'cntzero' => 'Қабул қилинмаган',
            'cntone' => 'Жараёнда',
            'cnttwo' => 'Бажарилган',
            'cntdead' => 'Муддати бузилган',
            'cntwithdead' => 'Муддати бузилиб бажарилган',
            'cnt0' => 'Кўрилмаган',
            'cnt1' => 'Янги',
            'cnt2' => 'Жараёнда',
            'cnt3' => 'Тасдиқланиши кутилмоқда',
            'cnt4' => 'Бажарилган',
            'cnt5' => 'Рад этилган',
            'paid_date' => 'Тўлов санаси',
        ];
    }

    public function getUser(){
        return $this->hasMany(User::className(),['company_id'=>'id']);
    }
    public function getRegion(){
        return $this->hasOne(Region::className(),['id'=>'region_id']);
    }
    public function getDistrict(){
        return $this->hasOne(District::className(),['id'=>'district_id']);
    }
    public function getGroup(){
        return $this->hasOne(CompanyGroup::className(),['id'=>'group_id']);
    }
    public function getType(){
        return $this->hasOne(CompanyType::className(),['id'=>'type_id']);
    }
    public function getVillage(){
        return $this->hasOne(Village::className(),['id'=>'village_id']);
    }
    public function getParent(){
        if($this->parent_id == -1){
            return "Танланмаган";
        }elseif($this->parent_id == 0){
            return "Ўзи юқори турувчи";
        }
        return $this->hasOne(Company::className(),['id'=>'parent_id']);
    }
    public static function findIdentity($id)
    {
        /*$sql = '(
         (`active_to` IS NOT NULL and `active_each`IS NOT NULL) and (CURDATE() BETWEEN `active_to` and `active_each`)
         ) OR (
         (`active_to` IS NOT NULL and `active_each` IS NULL) and (CURDATE()>=`active_to`)
         ) OR (
         (`active_to` IS NULL and `active_each` IS NOT NULL) and (CURDATE()<=`active_each`)
         ) OR (`active_to` IS NULL and `active_each` IS NULL)
         ';
        return static::find()->where(['id'=>$id])->andWhere($sql)->andWhere(['status'=>1])->one();*/

        return static::findOne($id);

    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        /*$sql = '(
         (`active_to` IS NOT NULL and `active_each`IS NOT NULL) and (CURDATE() BETWEEN `active_to` and `active_each`)
         ) OR (
         (`active_to` IS NOT NULL and `active_each` IS NULL) and (CURDATE()>=`active_to`)
         ) OR (
         (`active_to` IS NULL and `active_each` IS NOT NULL) and (CURDATE()<=`active_each`)
         ) OR (`active_to` IS NULL and `active_each` IS NULL)
         ';
        return static::find()->where(['email'=>$username])->andWhere(['status'=>1])->andWhere($sql)->one();*/

        return static::findOne(['inn'=>$username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->password;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->password === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password,$this->password);
    }

    public function encrypt(){
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        return true;
    }
}
