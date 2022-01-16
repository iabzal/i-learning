
<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пәндер';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">
    <p>
        <?= Html::a('<i class="fa fa-plus-circle"></i> Пән қосу', ['create'], ['class' => 'btn btn-success']) ?>
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
                    return '<a href="/admin/course/update?id=' . $model->id . '">' . $model->name . '</a>';
                },
                'headerOptions' => ['width' => '90%']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/admin/course/update?id='.$model->id);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/admin/course/delete?id='.$model->id,
                            ["aria-label" =>"Жою", "data-pjax" => "0", "data-confirm" => "Сіз бұл элементті жойғыңыз келеді ме?", "data-method" => "post"]);
                    },
                ],
                'headerOptions' => ['width' => '10%']
            ],
        ],
    ]); ?>


</div>
