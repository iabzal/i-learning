<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Info */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_desc')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'type')->dropDownList(\common\models\Info::getStatusList(), [
        'prompt' => 'Мәтін түрін таңдаңыз ...'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> Сақтау', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
