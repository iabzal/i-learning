<?php

namespace backend\controllers;

use backend\models\Admin;
use Yii;
use common\models\Teacher;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TeacherController implements the CRUD actions for Teacher model.
 */
class TeacherController extends Controller
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
     * Lists all Teacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Teacher::find()->orderBy([
                'created_at' => SORT_DESC
            ]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Teacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Teacher();

        if ($model->load(Yii::$app->request->post())) {
            $model->tmpImage = UploadedFile::getInstance($model, 'tmpImage');
            $model->created_at = time();
            $model->updated_at = time();
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Мұғалім қосылды');
                return $this->redirect(['/teacher']);
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
     * Updates an existing Teacher model.
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
                Yii::$app->session->setFlash('success', 'Мұғалім өзгертілді');
                return $this->redirect(['/teacher']);
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
     * Deletes an existing Teacher model.
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
     * Finds the Teacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teacher::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
