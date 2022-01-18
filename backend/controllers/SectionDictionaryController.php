<?php

namespace backend\controllers;

use backend\models\Admin;
use common\services\TextService;
use Yii;
use common\models\SectionDictionary;
use common\models\SectionDictionarySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SectionDictionaryController implements the CRUD actions for SectionDictionary model.
 */
class SectionDictionaryController extends Controller
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
     * Lists all SectionDictionary models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SectionDictionarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new SectionDictionary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SectionDictionary();

        $file = UploadedFile::getInstance($model, 'file');

        if ($model->load(Yii::$app->request->post()) && $model->saveData($file)) {
            Yii::$app->session->setFlash('success', 'Сөздік қосылды');
            return $this->redirect(['/section-dictionary']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SectionDictionary model.
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
            Yii::$app->session->setFlash('success', 'Сөздік өзгертілді');
            return $this->redirect(['/section-dictionary']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SectionDictionary model.
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
     * Finds the SectionDictionary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SectionDictionary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SectionDictionary::findOne($id)) !== null) {
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
