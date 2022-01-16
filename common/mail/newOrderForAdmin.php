<?php

/* @var string $name */
/* @var string $phone */
/* @var string $city */
/* @var string $address */
/* @var int $totalCost */
/* @var int $id */
/* @var $items \devanych\cart\Cart */
$models = $items->getItems();
?>
<div class="password-reset">
    <p>
        Заказ №<?= $id ?>
    </p>
    <p>
        Клиент <b><?= $name ?></b> оформил заказ на сайте “NewBorn Almaty” на следующие товары:
    </p>
    <table style="border: 1px solid #ddd; border-collapse: collapse; width: 100%;">
        <tr>
            <th style="text-align: left">
                id
            </th>
            <th style="text-align: left">
                Товар
            </th>
            <th style="text-align: left">
                Категория
            </th>
            <th style="text-align: left">
                Размер
            </th>
            <th style="text-align: left">
                Цена
            </th>
            <th style="text-align: left">
                Количество
            </th>
            <th style="text-align: left">
                Сумма
            </th>
        </tr>
        <?php
        foreach ($models as $model){?>
            <tr>
                <td>
                    <?= $model->getId() ?>
                </td>
                <td>
                    <?= $model->getProduct()->title ?>
                </td>
                <td>
                    <?= $model->getProduct()->categoryName ?>
                </td>
                <td>
                    <?= $model->getProduct()->cartSize ?>
                </td>
                <td>
                    <?= $model->getProduct()->price ?> тг
                </td>
                <td>
                    <?= $model->getQuantity() ?> шт
                </td>
                <td>
                    <?= $model->getCost() ?> тг
                </td>
            </tr>
        <?php }
        ?>
    </table>

    <p>
        Итог к оплате: <i><?= $totalCost ?> тг</i>
    </p>

    <p>
        Данные клиента: <br/>
        Имя: <i><?= $name ?></i><br/>
        Номер телефона: <i><?= $phone ?></i><br/>
        Город: <i><?= $city ?></i><br/>
        Адрес: <i><?= $address ?></i>
    </p>
</div>
