<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мұғалімдер';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">
    <p>
        <?= Html::a('<i class="fa fa-plus-circle"></i> Мұғалім қосу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'image',
                'format' => 'Raw',
                'value' => function($model){
                    $img = '<img class="img-in-table" src="/uploads/teacher/'.$model->image.'">';
                    return '<a href="/admin/teacher/update?id='.$model->id.'">'.$img.'</a>';
                },
                'headerOptions' => ['width' => '10%']
            ],
            [
                'attribute' => 'name',
                'headerOptions' => ['width' => '30%']
            ],
            [
                'attribute' => 'email',
                'headerOptions' => ['width' => '25%']
            ],
            [
                'attribute' => 'position',
                'headerOptions' => ['width' => '25%']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/admin/teacher/update?id='.$model->id);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/admin/teacher/delete?id='.$model->id,
                            ["aria-label" =>"Жою", "data-pjax" => "0", "data-confirm" => "Бұл элементті жойғыңыз келеді ме?", "data-method" => "post"]);
                    },
                ],
                'headerOptions' => ['width' => '5%']
            ],
        ],
    ]); ?>


</div>
