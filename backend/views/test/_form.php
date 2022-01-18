<?php

use common\models\Course;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tests */
/* @var $form yii\widgets\ActiveForm */

$formName = 'test_q';
$rmvBtnTxt = 'Жою ';

$js = <<< JS

var formName = "$formName", 
rmvBtnTxt = "$rmvBtnTxt",
nameMaxLength = "500";


$('.is-true-checkbox').on('change', function(){
    if($(this).prop('checked') === true){
            $(this).closest('.col-md-12').find('.is-true-checkbox').prop('checked', false);
            $(this).closest('.col-md-12').find('.is-true-checkbox').val(0);
            $(this).prop('checked', true);
            $(this).val(1);
        }
});

$('#add-input').on('click', function(){
    var parentDiv = $('#create_test_block');
    parentDiv.show();
    var colInputDiv = document.createElement('div');
    colInputDiv.setAttribute('class', 'col-md-12');
    colInputDiv.appendChild(createQuestionInput(formName, i));
    for (var answer = 1; answer < 5; answer++) {
        colInputDiv.appendChild(createAnswerInput(formName, i, answer));
    }
    
    var colRmvDiv = document.createElement('div');
    colRmvDiv.setAttribute('class', 'col-md-2');
    colRmvDiv.appendChild(createRemoveButton(rmvBtnTxt));
    
    var rowDiv = document.createElement('div');
    rowDiv.setAttribute('class', 'row');
    rowDiv.appendChild(colInputDiv);
    rowDiv.appendChild(colRmvDiv);

    parentDiv.append(rowDiv);
    i++;
});

$('.rmv-btn').on('click', function () {
    removeDiv(this);
});

$('.rmv-btn-update').on('click', function () {
    var key = $(this).data('key');
    $('#delete-' + key).val(1);
    $(this).parents('.row').hide();
});

function removeDiv(elem) {
    $(elem).parents('.row').remove();

}


function createQuestionInput(formName, i) {
    
    var textInputQuest = document.createElement('input');
    textInputQuest.setAttribute('maxlength', nameMaxLength);
    textInputQuest.setAttribute('name', formName + "[" + i + "][question_text]");
    textInputQuest.setAttribute('class', 'form-control');
    
    var text = document.createElement('div');
    text.innerHTML = "<h4>Сұрақ №"+i+"</h4>";
    
    var questionInput = document.createElement('div');
    questionInput.append(textInputQuest);
    
    var is_new = document.createElement('input');
    is_new.setAttribute('type', 'hidden');
    is_new.value = 1;
    is_new.setAttribute('name', formName + "[" + i + "][is_new]");
    
    var divQuest = document.createElement('div');
    divQuest.setAttribute('class', 'form-group');
    divQuest.appendChild(text);
    divQuest.append(textInputQuest);
    divQuest.append(is_new);
    
    return divQuest;
}

function createAnswerInput(formName, i, answer) {
    var textInputAnswer = document.createElement('input');
    textInputAnswer.setAttribute('maxlength', nameMaxLength);
    textInputAnswer.setAttribute('name', formName + "[" + i + "][answer]" + "["+ answer +"][text]");
    textInputAnswer.setAttribute('class', 'form-control');

    var text = document.createElement('div');
    text.innerHTML = "<h6>Жауап "+answer+"</h6>";
    
    var answerInput = document.createElement('div');
    answerInput.append(textInputAnswer);
    
    
    var div = document.createElement('div');
    div.setAttribute('class', 'checkbox');
    
    var label = document.createElement('label');
    
    var checkbox = document.createElement('input');
    checkbox.setAttribute('type', 'checkbox');
    checkbox.setAttribute('name', formName + "[" + i + "][answer][" + answer + "][is_true]");
    checkbox.setAttribute('class', 'is-true-checkbox');
    
    checkbox.addEventListener('change', function(){
        if($(this).prop('checked') === true){
            $(this).closest('.col-md-12').find('.is-true-checkbox').prop('checked', false);
            $(this).closest('.col-md-12').find('.is-true-checkbox').val(0);
            $(this).prop('checked', true);
            $(this).val(1);
        }
    });
    
    
    
    label.appendChild(checkbox);
    label.append('Дұрыс жауап');
    
    var divFlex =  document.createElement('div');
    divFlex.setAttribute('class', 'd-flex');
    divFlex.appendChild(textInputAnswer);
    divFlex.append(label);
    
    var divAnswer = document.createElement('div');
    divAnswer.setAttribute('class', 'form-group');
    divAnswer.appendChild(text);
    divAnswer.append(divFlex);
    
    
    return divAnswer;
}



function createRemoveButton(buttonText) {
    var remove_btn = document.createElement('button');
    remove_btn.setAttribute('type', 'button');
    remove_btn.setAttribute('class', 'btn btn-danger rmv-btn');
    remove_btn.textContent = buttonText;

    remove_btn.addEventListener("click", function () {
        removeDiv(this);
    });
    var remove_div = document.createElement('div');
    remove_div.setAttribute('class', 'form-group');
    remove_div.appendChild(remove_btn);
    return remove_div;
}

JS;

$this->registerJs($js);
?>
<style>
    #create_test_block {
        border: 1px solid #000000;
        margin: 2em 0;
        padding: 2em;
        display: none;
    }

    .d-flex {
        display: flex;
        justify-content: space-between;
    }

    .d-flex label {
        margin-left: 1em;
        width: 25%;
    }
    input[type="checkbox"] {
        margin-right: 7px;
    }
</style>
<script>
    var i = <?= count($model->questions) ?> + 1;
</script>
<div class="tests-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'course_id')->dropDownList(Course::getList(),
        ['prompt' => 'Пәнді таңдаңыз','id' => 'course-id']) ?>

    <?= $form->field($model, 'section_id')->widget(DepDrop::class, [
        'data' => $model->getSectionForDepdrop(),
        'options'=>['id'=>'section-id'],
        'pluginOptions'=>[
            'depends'=>['course-id'],
            'placeholder'=>'Тақырыпты таңдаңыз...',
            'url'=>Url::to(['/section/section'])
        ]
    ]) ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'min_score')->textInput() ?>

    <div class="row">

        <?php foreach ($model->questions as $id => $question): ?>
            <div class="col-md-12">
                <div class="form-group">
                    <div><h4>Сұрақ №<?= $id+1 ?></h4></div>

                    <input maxlength="500" name="test_q[<?= $question->id ?>][question_text]" class="form-control"
                           value="<?= $question->text ?>">
                    <input type="hidden" value="0" name="test_q[<?= $question->id ?>][is_new]">
                </div>
                <?php foreach ($question->answers as $key => $answer): ?>
                    <div class="form-group">
                        <div><h6>Жауап <?= $key+1 ?></h6></div>
                        <div class="d-flex">
                            <input maxlength="500" name="test_q[<?= $question->id ?>][answer][<?= $answer->id ?>][text]"
                                   class="form-control" value="<?= $answer->text ?>">
                            <label>
                                <input type="checkbox"
                                       name="test_q[<?= $question->id ?>][answer][<?= $answer->id ?>][is_true]"
                                       class="is-true-checkbox" value="<?= $answer->is_correct ?>" <?= $answer->is_correct ? 'checked':'' ?>>Дұрыс жауап</label></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button type="button" class="btn btn-danger rmv-btn"><span class="fa fa-minus-circle"></span> Құрылған тестті жою</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div id="create_test_block">

    </div>

    <button type="button" class="btn btn-success" style="margin-bottom: 10px;" id="add-input"> <span class="fa fa-plus-circle"></span> Тест құру</button>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> Сақтау', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
