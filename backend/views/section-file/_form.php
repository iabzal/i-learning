<?php

use common\models\Course;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SectionFile */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="section-file-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'course_id')->dropDownList(Course::getList(),
                ['prompt' => 'Пәнді таңдаңыз', 'id' => 'course-id']) ?>

            <?= $form->field($model, 'section_id')->widget(DepDrop::class, [
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
                    'accept' => 'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                ],
                'pluginOptions' => [
                    'required' => $model->file_name === null,
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
