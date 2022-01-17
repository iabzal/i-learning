<?php

namespace frontend\controllers;

use common\models\Course;
use common\models\Info;
use common\models\Review;
use common\models\Section;
use common\models\TestAnswers;
use common\models\TestQuestions;
use frontend\models\Search;
use Yii;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class CourseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $courses = Course::find()->all();
        $info = Info::find()->where(['type' => Info::BASTY_BET])->one();
        $reviews = Review::find()->orderBy(['created_at' => SORT_DESC])->all();
        return $this->render('index', [
            'courses' => $courses,
            'info' => $info,
            'reviews' => $reviews,
        ]);
    }

    /**
     * @param int $course_id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionLessons(int $course_id)
    {
        $lessons = Section::find()->byCourseId($course_id)->all();
        $courses = Course::find()->all();
        $course = Course::find()->byId($course_id)->one();
        $info = Info::find()->where(['type' => Info::BASTY_BET])->one();
        if (!$course) {
            throw new NotFoundHttpException('Пән табылмады');
        }
        return $this->render('lessons', [
            'lessons' => $lessons,
            'courses' => $courses,
            'title' => $course->name,
            'info' => $info,
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionShowLesson(int $id)
    {
        $lesson = Section::find()->byId($id)->one();
        $testQuestions = [];
        if (count($lesson->testList) > 0) {
            $testId = $lesson->testList[0]->id;
            $testQuestions = TestQuestions::find()->byTestId($testId)->all();
        }
        if (!$lesson) {
            throw new NotFoundHttpException('Сабақ табылмады');
        }
        return $this->render('show-lesson', [
            'lesson' => $lesson,
            'tests' => $testQuestions,
        ]);
    }
}
