<?php

use common\models\Course;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SectionPracticalWork */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="section-practical-work-form">

    <div class="row">
        <div class="col-md-6">

            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'course_id')->dropDownList(Course::getList(),
                ['prompt' => 'Пәнді таңдаңыз', 'id' => 'course-id']) ?>

            <?= $form->field($model, 'section_id')->widget(DepDrop::class, [
                'data' => $model->getSectionForDepdrop(),
                'options' => ['id' => 'section-id'],
                'pluginOptions' => [
                    'depends' => ['course-id'],
                    'placeholder' => 'Тақырыпты таңдаңыз...',
                    'url' => Url::to(['/section/section'])
                ]
            ]) ?>

            <?= $form->field($model, 'file')->widget(\kartik\file\FileInput::class, [
                'language' => 'kz',
                'options' => [
                    'multiple' => false,
                    'id' => 'section_file',
                ],
                'pluginOptions' => [
                    'initialPreview' => $model->file_name === null ? false : \yii\helpers\Url::to(['/section-file/get-file', 'id' => $model->id]),
                    'initialPreviewConfig' => [
                        [
                            'description' => $model->file_name,
                            'size' => $model->file_size,
                            'caption' => $model->name . '.' . $model->file_ext,
                            'key' => $model->id
                        ],
                    ],
                    'browseLabel' => '',
                    'removeLabel' => '',
                    'initialPreviewAsData' => true,
                    'initialPreviewFileType' => $model->file_ext,
                    'overwriteInitial' => true,
                    'showCancel' => false,
                    'showUpload' => false,
                ]
            ]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> Сақтау', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
