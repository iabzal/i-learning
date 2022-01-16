<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мәтін';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-index">

    <p>
        <?= Html::a('<i class="fa fa-plus-circle"></i> Мәтін қосу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'title',
                'format' => 'Raw',
                'value' => function ($model) {
                    return '<a href="/admin/info/update?id=' . $model->id . '">' . $model->title . '</a>';
                },
                'headerOptions' => ['width' => '90%']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/admin/info/update?id='.$model->id);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/admin/info/delete?id='.$model->id,
                            ["aria-label" =>"Жою", "data-pjax" => "0", "data-confirm" => "Бұл элементті жойғыңыз келеді ме?", "data-method" => "post"]);
                    },
                ],
                'headerOptions' => ['width' => '5%']
            ],
        ],
    ]); ?>


</div>
