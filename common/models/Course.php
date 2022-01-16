<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "course".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Section[] $sections
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @return array
     */
    public static function getList()
    {
        $models = self::find()->all();
        return ArrayHelper::map($models, 'id', 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
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
            'name' => 'Аты',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Sections]].
     *
     * @return \yii\db\ActiveQuery|SectionQuery
     */
    public function getSections()
    {
        return $this->hasMany(Section::className(), ['course_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CourseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CourseQuery(get_called_class());
    }
}
