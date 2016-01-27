<?php

/* @var $this yii\web\View */
/* @var \app\models\Category $model */
/* @var bool $short */

$short = (isset($short) && $short) ? true : false;

use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\BookHelper;
?>

<div class="card card-block">

    <?php if ($short): ?>
        <h3 class="card-title"><?= Html::a(Html::encode($model->name), ['/category/view', 'id' => $model->id]) ?></h3>
    <?php else: ?>
        <h3 class="card-title"><?= Html::encode($model->name) ?></h3>
        <p class="card-text">
            <?php
            if (empty($model->books)) {
                echo 'Нет книг';
            } else {
                echo '<b>Книги</b>: ' . implode(', ', BookHelper::getList($model->books));
            }
            ?>
        </p>
    <?php endif; ?>


    <?php if (!Yii::$app->user->isGuest): ?>
        <br>
        <div class="text-center">
            <?=Html::a('Редактировать', ['/category/update', 'id' => $model->id], ['class' => 'btn btn-default'])?>
            &nbsp;
            <?=Html::a('Удалить', ['/category/delete', 'id' => $model->id], ['class' => 'btn btn-default', 'data-confirm' => 'Подтверждение...'])?>
        </div>
    <?php endif; ?>

</div>