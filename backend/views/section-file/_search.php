<?php

use common\models\Course;
use common\models\Section;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SectionFileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="section-file-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <div class="row w-100 align-items-end">
        <div class="col-md-3">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'course_id')->dropDownList(Course::getList(),
                ['prompt' => 'Пәнді таңдаңыз ...','id' => 'course-id']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'section_id')->dropDownList(Section::getList(),
                ['prompt' => 'Тақырыпты таңдаңыз ...','id' => 'section-id']) ?>
        </div>

        <div class="col-md-6 form-group">
            <?= Html::submitButton('<i class="fa fa-search"></i> Іздеу', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-times"></i> Тазалау', '/admin/section', ['class' => 'btn btn-secondary ml-2']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
