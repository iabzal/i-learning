<?php

namespace backend\models;

use common\models\User;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property string $role
 * @property int $status
 * @property string $auth_key
 * @property string $agency
 * @property string $name
 * @property string $password
 * @property string $password_hash
 * @property string $password_reset_token
 * @property int $created_at
 * @property string $authKey
 * @property string $statusName
 * @property int $updated_at
 */
class Admin extends User
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const ROLE_ADMIN = 'admin';

    public $password;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin';
    }

    public static function findByRoleAdmin()
    {
        return static::findAll(['role' => self::ROLE_ADMIN]);
    }

    /**
     * @return mixed
     */
    public static function getCurrentId()
    {
        return \Yii::$app->user->id;
    }

    /**
     * @return mixed
     */
    public static function getCurrentRole()
    {
        return \Yii::$app->user->identity->role;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'email'],
            [['email'], 'required'],
            [['status'], 'integer'],
            [['full_name', 'email',], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['password', 'role'], 'string'],
            [['email', 'password'], 'trim'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Аты-жөні',
            'email' => 'Пошта',
            'role' => 'Роль',
            'status' => 'Статус',
            'auth_key' => 'Auth Key',
            'password' => 'Пароль (тек жаңа пароль құру үшін толтырылады)',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @return string[]
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => 'Активный',
            self::STATUS_DELETED => 'Не активный',
        ];
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return self::getStatusList()[$this->status];
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if (trim($this->password) != '') {
            $this->setPassword($this->password);
        }
        if ($insert) {
            $this->generateAuthKey();
        }
        return true;
    }
}
