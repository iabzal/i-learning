<?php

/* @var string $fullName */
/* @var string $login */
/* @var string $password */
/* @var string $linkToLogin */
?>
<div class="password-reset">
    <p>
        Здравствуйте, <?= $fullName ?>. <br/>
    </p>
    <p>
        Ваши данные для входа в личный кабинет: <br/>
        Логин: <i><?= $login ?></i><br/>
        Пароль: <i><?= $password ?></i>
    </p>
    <p>
        Можете войти через эту ссылку: <br/>
        <a href="<?= Yii::$app->getUrlManager()->getHostInfo().$linkToLogin?>"><?= Yii::$app->getUrlManager()->getHostInfo().$linkToLogin?></a>
    </p>
</div>
