<?php

namespace common\models;

use Imagine\Image\ManipulatorInterface;
use Yii;
use yii\helpers\StringHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property string $image
 * @property string $name
 * @property string $text
 * @property int $created_at
 * @property int $updated_at
 * @property UploadedFile $tmpImage
 */
class Review extends \yii\db\ActiveRecord
{
    public $tmpImage;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tmpImage', 'name', 'text', 'created_at', 'updated_at'], 'required'],
            [['image'], 'string'],
            [['tmpImage'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2],
            [['tmpImage'], 'required', 'on' => 'create', 'message' => 'Необходимо загрузить «Изображение».'],            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['text'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'tmpImage' => 'Сурет',
            'name' => 'Аты-жөні',
            'text' => 'Пікір',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        if (isset($this->image)) {
            $this->deleteOldImage();
        }
        return parent::beforeDelete();
    }

    /**
     * @return bool
     */
    protected function uploadImage()
    {
        if ($this->validate()) {
            if ($this->tmpImage) {
                $saveDir = Yii::getAlias('@frontend/web/uploads/review/');
                if (!file_exists($saveDir)) {
                    mkdir($saveDir, 0775, true);
                }
                if (Image::thumbnail($this->tmpImage
                    ->tempName, 300, 500, ManipulatorInterface::THUMBNAIL_OUTBOUND)
                    ->save($saveDir . $this->image, ['quality' => 80])) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    protected function deleteOldImage()
    {
        $oldImage = Yii::getAlias('@frontend') . '/web/uploads/review/' . $this->getOldAttribute('image');
        if ($this->image && file_exists($oldImage)) {
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
            $this->image = Yii::$app->security->generateRandomString() . '.' . $this->tmpImage->extension;
            $this->uploadImage();
        }
        $this->name = StringHelper::mb_ucfirst($this->name, 'UTF-8');
        $this->text = StringHelper::mb_ucfirst($this->text, 'UTF-8');
        $this->updated_at = time();
        return true;
    }
}
