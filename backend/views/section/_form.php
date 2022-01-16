<?php

use common\models\Course;
use common\models\Section;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Section */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="section-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_id')->dropDownList(Course::getList(),
        ['prompt' => 'Пәнді таңдаңыз ...','id' => 'course-id']) ?>

    <?= $form->field($model, 'quarter')->dropDownList(Section::getQuarterList(),
        ['prompt' => 'Тоқсан таңдаңыз ...','id' => 'quarter']) ?>

    <?= $form->field($model, 'video')->widget(\kartik\file\FileInput::class, [
        'language' => 'kz',
        'options' => [
            'multiple' => false,
            'id' => 'video_file',
            'accept' => 'video/*'
        ],
        'pluginOptions' => [
            'required' => $model->file_name === null,
            'initialPreview' => $model->file_name === null ? false : '<video class="kv-preview-data file-preview-video" controls="" style="width:213px;height:160px;" preload="metadata">
                <source src="'.$model->videoUrl.'" type="'.$model->file_mime_type.'">
                <div class="file-preview-other">
                    <span class="file-other-icon"><i class="glyphicon glyphicon-file"></i></span>
                </div>
            </video>',
            'initialPreviewConfig' => $model->file_mime_type === null ? [] : [
                'filetype' => $model->file_mime_type
            ],
            'initialPreviewAsData' => false,
            'initialPreviewFileType' => 'video',
            'browseLabel' => '',
            'removeLabel' => '',
            'overwriteInitial' => true,
            'showCancel' => false,
            'showUpload' => false
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> Сақтау', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
