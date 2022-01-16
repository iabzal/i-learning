<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = 'Ошибка.';
?>
<div class="site-error">

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Вышеприведенная ошибка произошла, когда веб-сервер обрабатывал ваш запрос.
    </p>
    <p>
        Пожалуйста, свяжитесь с нами, если вы считаете, что это ошибка сервера. Спасибо.
    </p>
    <a href="/admin">На главную</a>
</div>
