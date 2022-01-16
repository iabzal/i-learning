<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%tests}}".
 *
 * @property int $id
 * @property int $course_id
 * @property int $section_id
 * @property int $duration
 * @property int $min_score
 * @property string $created_at
 * @property string $updated_at
 * @property TestQuestions[] $questions
 * @property string $name
 */
class Tests extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tests}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['min_score', 'course_id', 'section_id'], 'required'],
            [['duration', 'min_score', 'course_id', 'section_id'], 'integer'],
            [['name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Тесттің аты',
            'course_id' => 'Курс',
            'section_id' => 'Тақырып',
            'duration' => 'Уақыты',
            'min_score' => 'Өтетін балл',
            'created_at' => 'Құрылды',
            'updated_at' => 'Жаңарды',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TestsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TestsQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(TestQuestions::class, ['test_id' => 'id']);
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
}
