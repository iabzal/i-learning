<?php

namespace backend\controllers;

use backend\models\Admin;
use Yii;
use common\models\Review;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ReviewController implements the CRUD actions for Review model.
 */
class ReviewController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return Admin::getCurrentRole() === Admin::ROLE_ADMIN;
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Review models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Review::find()->orderBy([
                'created_at' => SORT_DESC
            ]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Review model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Review();

        if ($model->load(Yii::$app->request->post())) {
            $model->tmpImage = UploadedFile::getInstance($model, 'tmpImage');
            $model->created_at = time();
            $model->updated_at = time();
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Пікір қосылды');
                return $this->redirect(['/review']);
            } else {
                Yii::error($model->getErrors());
                Yii::$app->session->setFlash('error', 'Что-то пошло не так. Попробуйте еще раз!');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Review model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->tmpImage = UploadedFile::getInstance($model, 'tmpImage');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Пікір өзгертілді');
                return $this->redirect(['/review']);
            } else {
                Yii::error($model->getErrors());
                Yii::$app->session->setFlash('error', 'Что-то пошло не так. Попробуйте еще раз!');
            }
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Review model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Review model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Review the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Review::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
