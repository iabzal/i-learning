<?php
/**
 * Created by PhpStorm.
 * User: Adlet
 * Date: 05.03.2019
 * Time: 17:09
 */

namespace frontend\controllers;

use common\models\TestAnswers;
use common\models\TestQuestions;
use common\models\TestResult;
use common\models\Tests;
use Throwable;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TestController extends Controller
{
    public function actionResult()
    {
        $testId = Yii::$app->request->post('test_id');
        $test = Tests::find()->byId($testId)->one();
        $result = Yii::$app->request->post('result');
        $testQuestions = $test->questions;
        $rightAnswer = [];
        foreach ($testQuestions as $item) {
            foreach ($item->answers as $answer) {
                if ($answer->is_correct === 1) {
                    $rightAnswer[$item->id] = $answer->id;
                }
            }
        }
        $res = 0;
        foreach ($result as $key=>$item) {
            if ($rightAnswer[$key] === $item * 1) {
                $res++;
            }
        }
        $score = round($res * 100/count($testQuestions));

        return $this->render('result', [
            'score' => $score,
            'question' => count($testQuestions),
            'correct' => $res,
        ]);
    }

    /**
     * @param $lesson_id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPass($lesson_id, $question_num)
    {
        //if (!PassedLessons::find()->byUserId(Yii::$app->user->id)->byLessonId($lesson_id)->exists()) {
            $test = Tests::find()->byLessonId($lesson_id)->one();
            if ($test === null) {
                Yii::$app->session->setFlash('danger', 'Тест еще не загрузили. Попробуйте позже');
                return $this->redirect(['/course/show-lesson?id='.$lesson_id]);
            }
            $testId = $test->id;

        $testCount = TestQuestions::find()->byTestId($test->id)->count();

        $question = TestQuestions::find()
            ->byTestId($testId)
            ->orderBy('id ASC')
            ->one();
        if ($question_num < $testCount) {
                return $this->render('go-test', [
                    'question' => $question,
                    'seconds' => 1642355228,
                    'lessonId' => $lesson_id,
                    'qNum' => $question_num++,
                ]);
            } else {
                $this->finishTest($test);
            }
        //}
        //Yii::$app->session->setFlash('warning', 'Этот тест уже пройден');
        return $this->redirect(['/course/show-lesson?id='.$lesson_id]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionSaveAnswer($id)
    {
        $test = Tests::find()->byLessonId($id)->one();
        if ($test === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $userId = Yii::$app->user->id;
        $testId = $test->id;

        /*if (time() >= strtotime($testResult->end_date)) {
            $this->finishTest($test);
        }*/

        $post = Yii::$app->request->post();
        if (!isset($post['test_id']) || !isset($post['answer_id']) || !isset($post['iid']) || !isset($post['question_id'])) {
            Yii::$app->session->setFlash('danger', 'Выберите ответ');
            return $this->redirect(['test/pass', 'lesson_id' => $id]);
        }

        if ($test->id != $post['test_id'] || $post['iid'] != 1303) {
            throw new NotFoundHttpException('Страницы нет');
        }

        $answerId = $post['answer_id'];
        $questionId = $post['question_id'];

        if (TestUserAnswers::find()->byTestId($testId)->byUserId($userId)->byQuestionId($questionId)->exists()) {
            //  Abzal
            return $this->redirect(['/my/course']);
        }

        $answer = TestAnswers::find()->byId($answerId)->one();

        if ($answer === null || $answer->question_id != $questionId) {
            return $this->redirect(['/my/course']);
        }

        $model = new TestUserAnswers();
        $model->user_id = $userId;
        $model->test_id = $testId;
        $model->question_id = $questionId;
        $model->is_correct = $answer->is_correct;
        $model->answer_id = $answer->id;
        if ($model->save()) {
            $lastQuestionId = TestUserAnswers::find()
                ->byUserId($userId)
                ->byTestId($testId)
                ->orderBy('question_id DESC')
                ->select('question_id')
                ->scalar();
            $question = TestQuestions::find()
                ->byTestId($testId)
                ->andWhere(['>', 'id', $lastQuestionId])
                ->orderBy('id ASC')
                ->one();

            if ($question !== null) {
                $qNum = TestUserAnswers::find()->byUserId($userId)->byTestId($testId)->count() + 1;
                $allLessonCount = Lessons::find()->byCourseId($test->course_id)->count();

                $passedCount = PassedLessons::find()->byCourseId($test->course_id)->byUserId($userId)->count();
                if ($passedCount == 0) {
                    $progress = 0;
                } else {
                    $progress = ($passedCount * 100) / $allLessonCount;
                }
                Yii::$app->view->params['progress'] = $progress;
                return $this->render('go-test', [
                    'question' => $question,
                    'seconds' => strtotime($testResult->end_date),
                    'lessonId' => $id,
                    'qNum' => $qNum,
                ]);
            } else {
                $this->finishTest($test);
            }
        } else {
            Yii::$app->session->setFlash('error', 'Возникла шибка');
            Yii::error($model->getErrors());
            return $this->redirect(['/my/course']);
        }
    }

    /**
     * @param $userId
     * @param Tests $test
     * @param TestResult $testResult
     * @return \yii\web\Response
     */
    protected function finishTest(Tests $test)
    {
        $testId = $test->id;
        $trx = Yii::$app->db->beginTransaction();
        try {
            $success = false;
            //$score = TestUserAnswers::find()->byUserId($userId)->byTestId($testId)->select('sum(is_correct)')->scalar();
            $score = 100;
            $allQuestionCount = TestQuestions::find()->byTestId($testId)->count();
            $result = ($score * 100) / $allQuestionCount;
            if ($result >= $test->min_score) {//success
                Yii::$app->session->setFlash('success', 'Тест окончен. Ваш результат  ' . $score . ' из ' . $allQuestionCount . ' Поздравляем Вы прошли тест!');
                /*$service = new PassLessonService($test->lesson_id, $userId, (int)$result);
                if ($service->execute()) {
                    $testResult->status = TestResult::STATUS_FINISHED;
                    $testResult->score = (int)$result;
                    if ($testResult->save()) {
                        $success = true;
                        Yii::$app->session->setFlash('success', 'Тест окончен. Ваш результат  ' . $score . ' из ' . $allQuestionCount . ' Поздравляем Вы прошли тест!');
                    } else {
                        Yii::error($testResult->getErrors());
                    }
                }*/
            } else {
                //$success = $testResult->delete();
                //TestUserAnswers::deleteAll(['test_id' => $testId, 'user_id' => $userId]);
                Yii::$app->session->setFlash('danger', 'Вы не смогли набрать проходной балл. Ваш результат  ' . $score . ' из ' . $allQuestionCount);
            }
            if ($success) {
                $trx->commit();
            } else {
                $trx->rollBack();
                Yii::$app->session->setFlash('error', 'Возникла внутренняя ошибка');
            }
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            Yii::error($e->getFile());
            Yii::error($e->getLine());
            $trx->rollBack();
        } catch (Throwable $e) {
            Yii::error('cannot delete current lesson');
            $trx->rollBack();
        }
        return $this->redirect(['/course/show-lesson?id=' . $test->section_id]);
    }
}