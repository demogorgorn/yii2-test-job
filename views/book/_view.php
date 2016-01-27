<?php

/* @var $this yii\web\View */
/* @var \app\models\Book $model */
/* @var bool $short */

$short = (isset($short) && $short) ? true : false;

use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\CategoryHelper;
use app\helpers\UserHelper;
?>

<div class="card card-block">
    <h3 class="card-title">
        <?php if ($short): ?>
            <?=Html::a(Html::decode($model->name), ['/book/view', 'id' => $model->id]) ?>
        <?php  else: ?>
            <?=Html::decode($model->name)?>
        <?php endif; ?>
    </h3>
    <?php if (!empty($model->cover)): ?>
        <div class="preview" style="background-image: url(<?=$model->cover?>)"></div>
    <?php endif; ?>
    <div class="card-text">
        <?=Html::decode($model->description)?>
    </div>
    <br>
    <p class="card-text">
        <?php
        if (empty($model->categories)) {
            echo 'Нет категорий';
        } else {
            echo '<b>Категории</b>: ' . implode(', ', CategoryHelper::getList($model->categories));
        }
        ?>
    </p>
    <p class="card-text">
        <?php
        if (empty($model->users)) {
            echo 'Нет авторов';
        } else {
            echo '<b>Авторы</b>: ' . implode(', ', UserHelper::getList($model->users));
        }
        ?>
    </p>
    <?php if (!empty($model->cover)): ?>
        <div class="text-center">
            <a href="<?=$model->file?>" class="btn btn-danger">Скачать</a>
        </div>
    <?php endif; ?>


    <?php if (!Yii::$app->user->isGuest): ?>
        <br>
        <div class="text-center">
            <?=Html::a('Редактировать', ['/book/update', 'id' => $model->id], ['class' => 'btn btn-default'])?>
            &nbsp;
            <?=Html::a('Удалить', ['/book/delete', 'id' => $model->id], ['class' => 'btn btn-default', 'data-confirm' => 'Подтверждение...'])?>
        </div>
    <?php endif; ?>
</div>