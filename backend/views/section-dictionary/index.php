<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SectionDictionarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сөздік';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-dictionary-index">

    <p>
        <?= Html::a('<i class="fa fa-plus-circle"></i> Сөздік қосу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'format' => 'Raw',
                'value' => function ($model) {
                    return '<a href="/admin/section-dictionary/update?id=' . $model->id . '">' . $model->name . '</a>';
                },
                'headerOptions' => ['width' => '30%']
            ],
            [
                'attribute' => 'course_id',
                'value' => 'course.name',
                'headerOptions' => ['width' => '30%']
            ],
            [
                'attribute' => 'section_id',
                'value' => 'section.name',
                'headerOptions' => ['width' => '30%']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/admin/section-dictionary/update?id='.$model->id);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/admin/section-dictionary/delete?id='.$model->id,
                            ["aria-label" =>"Жою", "data-pjax" => "0", "data-confirm" => "Бұл элементті жойғыңыз келеді ме?", "data-method" => "post"]);
                    },
                ],
                'headerOptions' => ['width' => '5%']
            ],
        ],
    ]); ?>


</div>
