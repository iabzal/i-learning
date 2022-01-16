<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%test_answers}}".
 *
 * @property int $id
 * @property int $question_id
 * @property string $text
 * @property int $is_correct
 */
class TestAnswers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%test_answers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'text'], 'required'],
            [['question_id', 'is_correct'], 'integer'],
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
            'question_id' => 'Сұрақ ID',
            'text' => 'Мәтін',
            'is_correct' => 'Дұрыс жауап',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TestAnswersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TestAnswersQuery(get_called_class());
    }
}
