<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="box p-4">
        <div class="box-body">
            <div class="row w-100">
                <div class="col-md-2">
                    <?= $form->field($model, 'name') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'surname') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'email') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'type')->dropDownList(\common\models\User::getTypeList(), ["prompt"=>"Не выбрано"]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'status')->dropDownList(\common\models\User::getStatusList(), ["prompt"=>"Не выбрано"]) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-search"></i> Поиск', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fa fa-times"></i> Сбросить', '/admin/users', ['class' => 'btn btn-secondary ml-2']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
