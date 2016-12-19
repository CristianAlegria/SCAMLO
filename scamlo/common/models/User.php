<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;
use yii\helpers\Security;
use backend\models\Role;
use yii\helpers\ArrayHelper;
use backend\models\Status;

/**

* User model
*
* @property integer $id
* @property string $nombre_completo
* @property string $cedula
* @property string $telefono
* @property string $password_hash
* @property string $password_reset_token
* @property string $email
* @property string $auth_key
* @property integer $role_id
* @property integer $status_id
* @property integer $created_at
* @property integer $updated_at
* @property string $password write-only password
*/

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVO = 10;

    public $passwordActual;
    public $passwordNueva;
    public $passwordConfirmada;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
            'class' => 'yii\behaviors\TimestampBehavior',
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                            ],
                'value' => new Expression('NOW()'),
                            ],
                ];
    }


    /**
        * validation rules
        */
    public function rules()
    {
            return [
            
                ['status_id', 'default', 'value' => self::STATUS_ACTIVO],
                [['status_id'],'in', 'range'=>array_keys($this->getStatusList())],
                ['status_id', 'required'],

                ['role_id', 'default', 'value' => 5],
                [['role_id'],'in', 'range'=>array_keys($this->getRoleList())],
                ['role_id', 'required'],

                ['nombre_completo', 'filter', 'filter' => 'trim'],
                ['nombre_completo', 'required'],
                ['nombre_completo', 'string', 'min' => 2],

                ['cedula', 'filter', 'filter' => 'trim'],
                ['cedula', 'required'],
                ['cedula', 'integer', 'max' => 999999999999, 'min' => 1],
                ['cedula', 'unique'],

                ['telefono', 'filter', 'filter' => 'trim'],
                ['telefono', 'required'],
                ['telefono', 'integer'],
                ['telefono', 'string', 'max' => 40, 'min' => 7],

                ['email', 'filter', 'filter' => 'trim'],
                ['email', 'required'],
                ['email', 'email'],
                ['email', 'unique'],
                ['email', 'string', 'max' => 100, 'min' => 7],
                ['password_hash', 'required'],
                [['passwordNueva', 'passwordConfirmada'], 'required'],
                ['passwordActual', 'validarpasswordActual'],
                ['passwordActual', 'safe'],
                [['passwordNueva', 'passwordConfirmada'], 'string', 'min' => 3, 'max' => 30],
                [['passwordNueva', 'passwordConfirmada'], 'filter', 'filter' => 'trim'],
                [['passwordConfirmada'], 'compare', 'compareAttribute' => 'passwordNueva', 'message' => 'La contraseña nueva y la confirmación deben ser iguales'],
                ];
    }

    /* Your model attribute labels */

    public function attributeLabels()
    {
        return [

                /* Your other attribute labels */
                'id' => Yii::t('app', 'No. de Trabajador'),
                'roleName' => Yii::t('app', 'Rol'),
                'statusName' => Yii::t('app', 'Estado'),
                'created_at' => Yii::t('app', 'Creado el'),
                'updated_at' => Yii::t('app', 'Actualizado el'),
                'status_id' => Yii::t('app', 'Estado'),
                'role_id' => Yii::t('app', 'Rol asignado'),
                'password_hash' => Yii::t('app', 'Contraseña'),
                'email' => Yii::t('app', 'Correo electrónico'),
                'cedula' => Yii::t('app', 'Cédula'),
                'telefono' => Yii::t('app', 'Telefono ó Celular'),
                'nombre_completo' => Yii::t('app', 'Nombres y apellidos'),
                'passwordActual' => Yii::t('app', 'Contraseña actual'),
                'passwordNueva' => Yii::t('app', 'Contraseña nueva'),
                'passwordConfirmada' => Yii::t('app', 'Confirmar contraseña'),
                ];
    }

    public function validarPasswordActual(){
        if(!$this->verificarPassword($this->passwordActual)){
            $this->addError("passwordActual", "Contraseña actual incorrecta");
        }
    }

    public function verificarPassword($password){
        $model = Yii::$app->user->identity;
        $dbpassword = static::findOne(['id' => $model->id, 'status_id' => self::STATUS_ACTIVO])->password_hash;
        return Yii::$app->security->validatePassword($password, $dbpassword);
    }

    /**
    * @findIdentity
    */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status_id' => self::STATUS_ACTIVO]);
    }

    /**
    * @findIdentityByAccessToken
    */

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    /**
    * Finds user by email
    * broken into 2 lines to avoid wordwrapping * @param string $emailemail
    * @return static|null
    */

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status_id' =>
        self::STATUS_ACTIVO]);
    }

    /**
    * Finds user by password reset token
    *
    * @param string $token password reset token
    * @return static|null
    */

    public static function findByPasswordResetToken($token)
    {
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
        // token e      xpired
        return null;
    }
        return static::findOne([
        'password_reset_token' => $token,
        'status_id' => self::STATUS_ACTIVO,
        ]);
    }

    /**
    * @getId
    */

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
    * @getAuthKey
    */

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
    * @validateAuthKey
    */

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
    * Validates password
    *
    * @param string $password password to validate
    * @return boolean if password provided is valid for current user
    */

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
    * Generates password hash from password and sets it to the model
    *
    * @param string $password
    */

    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
    * Generates password hash from password and sets it to the model
    *
    * @param string $password
    */

    public function setPasswordReset($password)
    {
        
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);

    }

    /**
    * Generates "remember me" authentication key
    */

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }


    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }


    /**
    * Generates new password reset token
    * broken into 2 lines to avoid wordwrapping
    */

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString()
        . '_' . time();
    }

    /**
    * Removes password reset token
    */

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }


    public function getRole()
    {
        return $this->hasOne(Role::className(), ['role_value' => 'role_id']);
    }

    /**
    * get role name
    *
    */

    public function getRoleName()
    {
        return $this->role ? $this->role->role_name : '- no role -';
    }

    /**
    * get list of roles for dropdown
    */
    public static function getRoleList()
    {
        $droptions = Role::find()->asArray()->all();
        return Arrayhelper::map($droptions, 'role_value', 'role_name');
    }

    /**
    * get status relation
    *
    */

    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['status_value' => 'status_id']);
    }

    /**
    * get status name
    *       
    */
    public function getStatusName()
    {
        return $this->status ? $this->status->status_name : '- no status -';
    }
    /**
    * get list of statuses for dropdown
    */
    public static function getStatusList()
    {
        $droptions = Status::find()->asArray()->all();
        return Arrayhelper::map($droptions, 'status_value', 'status_name');
    }

}