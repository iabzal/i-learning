<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .mh-60 {
        min-height: 60vh
    }
    .site-error {
        padding: 2em 0;
    }
</style>
<div class="container mh-60">
    <div class="site-error">

        <h1><?=$title?></h1>

        <a onclick="javascript:history.back(); return false;" href="#" class="link link--back">
            Назад
        </a>

    </div>

</div>