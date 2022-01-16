<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пікір';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index">

    <p>
        <?= Html::a('<i class="fa fa-plus-circle"></i> Пікір қосу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'image',
                'format' => 'Raw',
                'value' => function($model){
                    $img = '<img class="img-in-table" src="/uploads/review/'.$model->image.'">';
                    return '<a href="/admin/review/update?id='.$model->id.'">'.$img.'</a>';
                },
                'headerOptions' => ['width' => '10%']
            ],
            [
                'attribute' => 'name',
                'headerOptions' => ['width' => '40%']
            ],
            [
                'attribute' => 'text',
                'headerOptions' => ['width' => '40%']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/admin/review/update?id='.$model->id);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/admin/review/delete?id='.$model->id,
                            ["aria-label" =>"Жою", "data-pjax" => "0", "data-confirm" => "Бұл элементті жойғыңыз келеді ме?", "data-method" => "post"]);
                    },
                ],
                'headerOptions' => ['width' => '5%']
            ],
        ],
    ]); ?>


</div>
