<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "section_file".
 *
 * @property int $id
 * @property string $name
 * @property int $course_id
 * @property int $section_id
 * @property string|null $file_name
 * @property string|null $file_mime_type
 * @property string|null $file_ext
 * @property int|null $file_size
 * @property int $created_at
 * @property int $updated_at
 * @property UploadedFile $file
 * @property string $fileUrl
 */
class SectionFile extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'course_id', 'section_id', 'created_at', 'updated_at'], 'required'],
            [['course_id', 'section_id', 'file_size', 'created_at', 'updated_at'], 'integer'],
            [['name', 'file_name', 'file_mime_type', 'file_ext'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Аты',
            'course_id' => 'Курс',
            'section_id' => 'Тақырып',
            'file' => 'Файл',
            'file_name' => 'Аты',
            'file_mime_type' => 'File Mime Type',
            'file_ext' => 'File Ext',
            'file_size' => 'File Size',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::class, ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::class, ['id' => 'section_id']);
    }


    /**
     * @param null|UploadedFile $file
     * @param bool $update
     * @return bool
     */
    public function saveData($file = null, $update = false)
    {
        $trx = Yii::$app->db->beginTransaction();
        try {
            $success = false;
            if ($file !== null) {
                $saveDir = Yii::getAlias('@frontend/web/uploads/section_file/');
                if (!file_exists($saveDir)) {
                    mkdir($saveDir, 0775, true);
                }
                if (!$update) {
                    do {
                        $fileName = Yii::$app->security->generateRandomString(10) . '.' . $file->extension;
                    } while (file_exists($saveDir . $fileName));
                } else {
                    $fileName = $this->file_name;
                }
                if (!$update) {
                    $this->created_at = time();
                }
                $this->updated_at = time();
                $this->file_name = $fileName;
                $this->file_size = $file->size;
                $this->file_ext = $file->extension;
                $this->file_mime_type = mime_content_type($file->tempName);
            }
            if ($this->save()) {
                if ($file !== null) {
                    if ($file->saveAs($saveDir . $fileName)) {
                        $success = true;
                    }
                } else {
                    $success = true;
                }
            } else {
                Yii::error($this->getErrors());
            }
            if ($success) {
                $trx->commit();
            } else {
                $trx->rollBack();
            }
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            Yii::error($e->getLine());
            Yii::error($e->getFile());
            $trx->rollBack();
        }
        return $success;
    }

    public function getFilePath()
    {
        return Yii::getAlias('@frontend/web/uploads/section_file/') . $this->file_name;
    }

    public function getFileUrl()
    {
        return '/uploads/section_file/' . $this->file_name;
    }
}
