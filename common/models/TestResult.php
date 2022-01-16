<?php

namespace common\models;


/**
 * This is the model class for table "{{%test_result}}".
 *
 * @property int $id
 * @property int $test_id
 * @property int $user_id
 * @property int $score
 * @property int $status
 * @property string $begin_date
 * @property string $end_date
 */
class TestResult extends \yii\db\ActiveRecord
{

    const STATUS_STARTED = 10;
    const STATUS_FINISHED = 20;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%test_result}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'user_id', 'score', 'status'], 'integer'],
            [['begin_date', 'end_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Тест ID',
            'user_id' => 'Оқушы ID',
            'score' => 'Score',
            'status' => 'Статус',
            'begin_date' => 'Begin Date',
            'end_date' => 'End Date',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TestResultQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TestResultQuery(get_called_class());
    }
}
