<?php

namespace common\models;

use Imagine\Image\ManipulatorInterface;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "section".
 *
 * @property int $id
 * @property string $name
 * @property int $quarter
 * @property string|null $video
 * @property int $course_id
 * @property int $created_at
 * @property int $updated_at
 * @property string $file_name
 * @property string $file_mime_type
 * @property string $file_ext
 * @property int $file_size
 * @property string $filePath
 * @property string $videoUrl
 * @property SectionFile[] $fileList
 * @property SectionDictionary[] $dictionaryList
 * @property SectionPracticalWork[] $pWorkList
 * @property Tests[] $testList
 *
 * @property Course $course
 */
class Section extends \yii\db\ActiveRecord
{
    public $video;

    const QUARTER_LIST = [
        1 => '1-тоқсан',
        2 => '2-тоқсан',
        3=> '3-тоқсан',
        4 => '4-тоқсан',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section';
    }

    /**
     * @return array
     */
    public static function getList()
    {
        $models = self::find()->all();
        return ArrayHelper::map($models, 'id', 'name');
    }

    public static function getQuarterList()
    {
        return self::QUARTER_LIST;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'quarter', 'course_id', 'created_at', 'updated_at'], 'required'],
            [['quarter', 'course_id', 'file_size', 'created_at', 'updated_at'], 'integer'],
            [['name', 'file_name', 'file_mime_type', 'file_ext'], 'string', 'max' => 255],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
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
            'quarter' => 'Тоқсан',
            'file_name' => 'Видео аты',
            'file_mime_type' => 'Видео типі',
            'file_ext' => 'Видео кеңейтілімі',
            'file_size' => 'Видео өлшемі',
            'video' => 'Видео',
            'course_id' => 'Курс',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery|CourseQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::class, ['id' => 'course_id']);
    }

    /**
     * {@inheritdoc}
     * @return SectionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SectionQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function getQuarterName()
    {
        return self::QUARTER_LIST[$this->quarter];
    }

    /**
     * @return string
     */
    public function getVideoUrl()
    {
        return '/uploads/section/' . $this->file_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileList()
    {
        return $this->hasMany(SectionFile::className(), ['section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDictionaryList()
    {
        return $this->hasMany(SectionDictionary::className(), ['section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPWorkList()
    {
        return $this->hasMany(SectionPracticalWork::className(), ['section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestList()
    {
        return $this->hasMany(Tests::className(), ['section_id' => 'id']);
    }
}
