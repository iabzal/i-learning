<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%test_questions}}".
 *
 * @property int $id
 * @property string $text
 * @property TestAnswers[] $answers
 * @property int $test_id
 */
class TestQuestions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%test_questions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'test_id'], 'required'],
            [['test_id'], 'integer'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Мәтін',
            'test_id' => 'Тест ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TestQuestionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TestQuestionsQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(TestAnswers::class,['question_id' => 'id']);
    }
}
