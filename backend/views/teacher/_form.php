<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Teacher */
/* @var $form yii\widgets\ActiveForm */

$image = '';
if ($model->image != null) {
    $image = Html::img('/uploads/teacher/' . $model->image);
}
?>

<div class="teacher-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">

            <label class="control-label" for="category-tmpimage">Сурет</label>
            <div class="rec-text text-red mb-2">Ұсынылатын өлшем: 300х500</div>
            <?= $form->field($model, 'tmpImage')->widget(FileInput::classname(), [
                'name' => 'input-ru[]',
                'language' => 'kz',
                'options' => [
                    'multiple' => false,
                    'accept' => 'image/*',
                ],
                'pluginOptions' => [
                    'browseLabel' => '',
                    'removeLabel' => '',
                    'initialPreview' => $image,
                    'showCancel' => false,
                    'showUpload' => false
                ]
            ])->label(false); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
