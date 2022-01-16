<?php
namespace common\models;

use backend\models\Ambassador;
use backend\models\Employer;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Imagine\Image\ManipulatorInterface;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * User model
 *
 * @property integer $id
 * @property string $unique_link
 * @property string $avatar
 * @property string $phone
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $bg_color
 * @property string $name
 * @property string $surname
 * @property string $position
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property string $type
 * @property string $image
 * @property UploadedFile $tmpImage
 * @property integer $address
 * @property integer $city
 * @property integer $created_at
 * @property integer $updated_at
 * @property null|string $contacts
 * @property null|string $socials
 * @property string $statusName
 * @property mixed $contact
 * @property mixed $inventory
 * @property mixed $addInfo
 * @property string $fullName
 * @property string $typeName
 * @property mixed $social-network
 * @property string $linkPage
 * @property string $authKey
 * @property string $ambassador_id
 * @property string $employer_id
 * @property string $ambassadorName
 * @property string $password write-only password
 * @property string $new_password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $tmpImage;
    public $new_password;

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    const STANDARD = 1000;
    const PREMIUM = 2000;


    const BG_COLOR_BLACK = 'black';
    const BG_COLOR_WHITE = 'white';

    const KAZAKHSTAN = 'Казахстан';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @return mixed
     */
    public static function getCurrentEmail()
    {
        return \Yii::$app->user->identity->email;
    }

    public static function findByPhone($phone)
    {
        return static::findOne(['phone' => $phone, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public static function findById($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function getCityList()
    {
        return [
            'Алматы' => 'Алматы',
            'Талдыкорган' => 'Талдыкорган',
            'Нур-Султан' => 'Нур-Султан',
            'Тараз' => 'Тараз',
            'Шымкент' => 'Шымкент',
            'Кызылорда' => 'Кызылорда',
            'Усть-Каменогорск' => 'Усть-Каменогорск',
            'Семей' => 'Семей',
            'Уральск' => 'Уральск',
            'Актобе' => 'Актобе',
            'Атырау' => 'Атырау',
            'Актау' => 'Актау',
            'Павлодар' => 'Павлодар',
            'Караганда' => 'Караганда',
            'Костанай' => 'Костанай',
            'Петропавловск' => 'Петропавловск',
            'Кокшетау' => 'Кокшетау',
        ];
    }

    public static function getBgColor()
    {
        return [
            self::BG_COLOR_BLACK => 'Темный',
            self::BG_COLOR_WHITE => 'Белый',
        ];
    }

    public static function findByUniqueLink($uniqueLink)
    {
        return static::findOne(['unique_link' => $uniqueLink]);
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => 'Активный',
            self::STATUS_INACTIVE => 'Не активный',
        ];
    }

    public static function getTypeList()
    {
        return [
            self::STANDARD => 'Стандарт',
            self::PREMIUM => 'Премиум',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            ['type', 'default', 'value' => self::STANDARD],
            ['type', 'in', 'range' => [self::STANDARD, self::PREMIUM]],
            [['email', 'unique_link'], 'unique'],
            [['new_password', 'name', 'surname', 'bg_color'], 'string'],
            [['employer_id'], 'integer'],
            [['tmpImage'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'unique_link' => 'Ссылка',
            'bg_color' => 'Цвет карточки',
            'avatar' => 'Аватар',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'fullName' => 'ФИО',
            'position' => 'Место работы',
            'email' => 'Email',
            'address' => 'Адрес',
            'city' => 'Город',
            'status' => 'Статус',
            'statusName' => 'Статус',
            'type' => 'Класс',
            'typeName' => 'Класс',
            'image' => 'Аватар',
            'linkPage' => 'Ссылка',
            'contacts' => 'Контакты',
            'socials' => 'Соц. сеть',
            'ambassador_id' => 'Амбассадор',
            'employer_id' => 'Адмимнистратор компании',
            'new_password' => 'Пароль',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
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
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     * @throws \yii\base\Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->name .' '. $this->surname;
    }

    /**
     * @return string
     */
    public function getAmbassadorName()
    {
        if ($this->ambassador_id) {
            return Ambassador::getNameById($this->ambassador_id);
        }
        return "-";
    }

    /**
     * @return string
     */
    public function getEmployerName()
    {
        if ($this->employer_id) {
            return Employer::getNameById($this->employer_id);
        }
        return "-";
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return self::getStatusList()[$this->status];
    }

    /**
     * @return string
     */
    public function getTypeName()
    {
        return self::getTypeList()[$this->type];
    }

    /**
     * @return string
     */
    public function getLinkPage()
    {
        return 'user/'.$this->unique_link;
    }

    public function getContact()
    {
        return Contact::findContactByUser($this->id);
    }

    public function getSocial()
    {
        return Social::findSocialByUser($this->id);
    }

    public function getAddInfo()
    {
        return AdditionalInformation::findAddInfoByUser($this->id);
    }

    public function getInventories()
    {
        return Inventory::findInventoriesByUser($this->id);
    }

    public function getContacts()
    {
        $contact = Contact::findContactByUser($this->id);
        if ($contact) {
            return
                'Номер телефона: '. $contact->phone_number. ',
                 Whatsapp: ' .$contact->whatsapp. ',
                 Telegram: ' .$contact->telegram. ',
                 Веб-сайт: ' .$contact->website;
        }
        return null;
    }

    public function getSocials()
    {
        $social = Social::findSocialByUser($this->id);
        if ($social) {
            return
                'Instagram: '. $social->instagram. ',
                 Facebook: ' .$social->facebook. ',
                 Twitter: ' .$social->twitter. ',
                 Linkedin: ' .$social->linkedin;
        }
        return null;
    }

    /**
     * @param int $type
     * @return string
     */
    public static function getTypeNameByType($type)
    {
        return self::getTypeList()[$type];
    }

    public function beforeDelete()
    {
        if (isset($this->avatar)) {
            $this->deleteOldImage();
        }
        return parent::beforeDelete();
    }

    protected function uploadImage()
    {
        if ($this->validate()) {
            if ($this->tmpImage) {
                if (Image::thumbnail($this->tmpImage
                    ->tempName, 200, 200, ManipulatorInterface::THUMBNAIL_OUTBOUND)
                    ->save(Yii::getAlias('@frontend') . '/web/uploads/user-images/' . $this->avatar, ['quality' => 80])) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    protected function deleteOldImage()
    {
        $oldImage = Yii::getAlias('@frontend') . '/web/uploads/user-images/' . $this->getOldAttribute('avatar');
        if ($this->avatar && file_exists($oldImage)) {
            if (!unlink($oldImage)) {
                return false;
            }
        }
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
        if ($this->tmpImage) {
            $this->deleteOldImage();
            $this->avatar = Yii::$app->security->generateRandomString() . '.' . $this->tmpImage->extension;
            $this->uploadImage();
        }
        if ($insert) {
            $this->generateAuthKey();
        }
        return true;
    }
}
