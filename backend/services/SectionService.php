<?php
namespace backend\services;

use common\models\Section;
use Yii;
use yii\web\UploadedFile;

class SectionService
{

    /* @var Section */
    protected $model;

    /* @var UploadedFile */
    protected $videoFile;

    private $newModel;

    public function __construct(Section $model, $newModel = true)
    {
        $this->model = $model;
        $this->newModel = $newModel;
    }


    /**
     * @return bool
     */
    public function execute()
    {
        $model = $this->model;
        $model->created_at = time();
        $model->updated_at = time();
        $this->videoFile = UploadedFile::getInstance($model, 'video');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $trx = Yii::$app->db->beginTransaction();
            try {
                $success = true;

                $success = $success && $this->saveModel();
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
        return false;
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    private function saveModel()
    {
        $success = false;
        $file = $this->videoFile;
        $model = $this->model;
        $saveDir = Yii::getAlias('@frontend/web/uploads/section/');
        if (!file_exists($saveDir)) {
            mkdir($saveDir, 0775, true);
        }
        if ($this->newModel) {
            do {
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $file->extension;
            } while (file_exists($saveDir . $fileName));
        } else {
            $fileName = $this->model->file_name;
        }

        if ($file !== null) {
            $model->file_name = $fileName;
            $model->file_size = $file->size;
            $model->file_ext = $file->extension;
            $model->file_mime_type = mime_content_type($file->tempName);
        }
        if ($model->save()) {
            if ($file !== null) {
                if ($file->saveAs($saveDir . $fileName)) {
                    $success = true;
                } else {
                    Yii::error("cannot save video of offline course");
                }
            } else {
                $success = true;
            }
        } else {
            Yii::error($model->getErrors());
        }
        return $success;
    }

}