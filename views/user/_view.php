<?php

/* @var $this yii\web\View */
/* @var \app\models\User $model */
/* @var bool $short */

$short = (isset($short) && $short) ? true : false;

use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\BookHelper;
?>


<div class="card card-block">
    <h3 class="card-title">
        <?php if ($short): ?>
            <?=Html::a(Html::encode($model->name) . ' ' . Html::encode($model->surname), ['/user/view', 'id' => $model->id], ['class' => 'ajax']) ?>
        <?php  else: ?>
            <?=Html::encode($model->name) , ' ' , Html::encode($model->surname)?>
        <?php endif; ?>
    </h3>

    <div class="card-text clear">
        <div class="user-avatar" style="background-image: url(<?=$model->getAvatar()?>)"></div>
        <?=nl2br(Html::encode($model->about_me))?>
    </div>

    <div class="card-text">
        <?php
        if (empty($model->books)) {
            echo 'Нет книг';
        } else {
            echo '<b>Книги</b>: ' . implode(', ', BookHelper::getList($model->books));
        }
        ?>
    </div>
</div>
