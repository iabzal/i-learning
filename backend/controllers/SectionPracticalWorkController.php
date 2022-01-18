<?php

namespace backend\controllers;

use backend\models\Admin;
use common\services\TextService;
use Yii;
use common\models\SectionPracticalWork;
use common\models\SectionPracticalWorkSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SectionPracticalWorkController implements the CRUD actions for SectionPracticalWork model.
 */
class SectionPracticalWorkController extends Controller
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
     * Lists all SectionPracticalWork models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SectionPracticalWorkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new SectionPracticalWork model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SectionPracticalWork();

        $file = UploadedFile::getInstance($model, 'file');

        if ($model->load(Yii::$app->request->post()) && $model->saveData($file)) {
            Yii::$app->session->setFlash('success', 'Практикалық жұмыс қосылды');
            return $this->redirect(['/section-practical-work']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SectionPracticalWork model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $file = UploadedFile::getInstance($model, 'file');

        if ($model->load(Yii::$app->request->post()) && $model->saveData($file, true)) {
            Yii::$app->session->setFlash('success', 'Практикалық жұмыс өзгертілді');
            return $this->redirect(['/section-practical-work']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SectionPracticalWork model.
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
     * Finds the SectionPracticalWork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SectionPracticalWork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SectionPracticalWork::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionGetFile($id)
    {
        $model = $this->findModel($id);
        $fileName = TextService::createSlag($model->name) . '.' . $model->file_ext;
        return Yii::$app->response->sendFile($model->getFilePath(), $fileName,[
            'mimeType' => $model->file_mime_type, 'inline' => true
        ]);
    }
}
