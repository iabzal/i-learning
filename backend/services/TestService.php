<?php
/**
 * Created by PhpStorm.
 * User: Adlet
 * Date: 04.03.2019
 * Time: 20:49
 */

namespace backend\services;


use common\models\TestAnswers;
use common\models\TestQuestions;
use common\models\Tests;
use Yii;

class TestService
{

    protected $model;

    public function __construct(Tests $model)
    {
        $this->model = $model;
    }


    public function execute()
    {
        $postData = Yii::$app->request->post();
        $model = $this->model;
        $trx = Yii::$app->db->beginTransaction();
        try {
            if (!$model->load($postData)) {
                return false;
            }
            $post = $postData['test_q'];
            $success = true;
            if ($model->save()) {
                foreach ($post as $id => $data) {
                    if ($data['is_new']) {
                        $question = new TestQuestions();
                        $question->test_id = $model->id;
                    } else {
                        $question = TestQuestions::find()->byId($id)->one();
                    }
                    $question->text = $data['question_text'];
                    if ($question->save()) {
                        foreach ($data['answer'] as $key => $data2) {
                            if ($data['is_new']) {
                                $answer = new TestAnswers();
                                $answer->question_id = $question->id;
                            } else {
                                $answer = TestAnswers::find()->byId($key)->one();
                            }
//                            Yii::error(print_r($answer, true));
                            $text = $data2['text'];
                            $answer->text = $text;
                            if (isset($data2['is_true']) && $data2['is_true'] == 1) {
                                $answer->is_correct = 1;
                            } else {
                                $answer->is_correct = 0;
                            }
                            if (!$answer->save()) {
                                $success = false;
                                Yii::error($answer->getErrors());
                            }
                        }
                    } else {
                        $success = false;
                        Yii::error($question->getErrors());
                    }
                }
            } else {
                $success = false;
                Yii::error($model->getErrors());
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
            $success = false;
        }
        return $success;
    }
}