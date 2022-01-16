<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'surname')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'type')->dropDownList(\common\models\User::getTypeList()) ?>
    <?= $form->field($model, 'employer_id')->dropDownList(\backend\models\Employer::getEmployerList(), ["prompt"=>"Не выбрано"]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
