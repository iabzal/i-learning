<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Review */
/* @var $form yii\widgets\ActiveForm */

$image = '';
if ($model->image != null) {
    $image = Html::img('/uploads/review/' . $model->image);
}

?>

<div class="review-form">

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

            <?= $form->field($model, 'text')->textarea(['rows' => 5]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> Сақтау', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
