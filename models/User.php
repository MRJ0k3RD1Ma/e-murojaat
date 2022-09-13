<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $role_id
 * @property int $company_id
 * @property string $name
 * @property string $image
 * @property string $username
 * @property string $password
 * @property string|null $phone
 * @property string|null $address
 * @property int $bulim_id
 * @property int $lavozim_id
 * @property int $is_rahbar
 * @property int $is_registration
 * @property int $is_resolution
 * @property int $is_control
 * @property int $is_control_system
 * @property string $created
 * @property string $updated
 * @property int $status
 * @property int $active
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'name', 'username', 'bulim_id', 'lavozim_id'], 'required'],
            ['password', 'required','on'=>'insert'],
            [['role_id', 'company_id', 'bulim_id', 'lavozim_id', 'is_rahbar', 'is_registration', 'is_resolution','is_control_district', 'is_control', 'is_control_system', 'status', 'active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'image', 'username', 'address'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 500],
            [['phone'], 'string', 'max' => 20],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Фойдаланувчи ҳуқуқи',
            'company_id' => 'Ташкилот',
            'name' => 'ФИО',
            'image' => 'Расм',
            'username' => 'Логинь',
            'password' => 'Пароль',
            'phone' => 'Телефон',
            'address' => 'Манзил',
            'bulim_id' => 'Бўлим',
            'lavozim_id' => 'Лавозим',
            'is_rahbar' => 'Раҳар ҳуқуқи',
            'is_control_district' => 'Туман бўйича назорат',
            'is_registration' => 'Регистратор ҳуқуқи',
            'is_resolution' => 'Резалютсия ёзиш  ҳуқуқи',
            'is_control' => 'назорат ҳуқуқи',
            'is_control_system' => 'Вилоят бўйича назорат',
            'created' => 'Created',
            'updated' => 'Updated',
            'status' => 'Status',
            'active' => 'Active',
        ];
    }

    public function getBulim(){
        return $this->hasOne(Bulim::className(),['id'=>'bulim_id']);
    }
    public function getLavozim(){
        return $this->hasOne(Lavozim::className(),['id'=>'lavozim_id']);
    }
    public function encrypt(){
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        return true;
    }
    public function getCompany(){
        return $this->hasOne(Company::className(),['id'=>'company_id']);
    }
    /**
     * @inheritdoc
     */
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
        return static::findOne(['username'=>$username]);
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
}
