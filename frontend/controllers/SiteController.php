<?php

namespace frontend\controllers;

use common\models\AboutCompany;
use common\models\Banner;
use common\models\Info;
use common\models\Product;
use common\models\ProductCategory;
use common\models\Review;
use common\models\Teacher;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\Search;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\Exception;
use yii\base\InvalidArgumentException;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
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
        $info = Info::find()->where(['type' => Info::BASTY_BET])->one();
        return $this->render('index', [
            'info' => $info
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $info = Info::find()->where(['type' => Info::BIZ_TURALY])->one();
        $teachers = Teacher::find()->all();
        $reviews = Review::find()->orderBy(['created_at' => SORT_DESC])->all();
        return $this->render('about', [
            'info' => $info,
            'teachers' => $teachers,
            'reviews' => $reviews,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionNews()
    {
        //$model = AboutCompany::find()->one();
        return $this->render('news', [
            //'about' => $model,
            //'salesHits' => $salesHits,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionContact()
    {
        //$model = AboutCompany::find()->one();
        return $this->render('contact', [
            //'about' => $model,
            //'salesHits' => $salesHits,
        ]);
    }

    /**
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionSearch()
    {
        $modelSearch = new Search();
        if ($modelSearch->load(Yii::$app->request->get()) && $modelSearch->validate()) {
            $text = $modelSearch->text ? $text = $modelSearch->text: $text = $modelSearch->query;
            $query = Product::findProductsBySearchTextWithPagination($text);
            $pages = new Pagination([
                'defaultPageSize' => 8,
                'totalCount' => $query->count(),
            ]);
            $products = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
            return $this->render('search', [
                'products' => $products,
                'pages' => $pages,
                'text' => $text,
            ]);
        }
        return $this->render('search-error', []);
    }

    public function actionSearchProduct($term)
    {
        if (Yii::$app->request->isAjax) {
            $results = [];
            $q = addslashes($term);
            foreach (Product::find()->where("(`title` like '%{$q}%')")->all() as $model) {
                $results[] = [
                    'id' => $model['title'],
                    'label' => $model['title'],
                ];
            }
            return Json::encode($results);
        }
        return [];
    }
}
