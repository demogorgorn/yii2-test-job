<?php

/* @var $this yii\web\View */
/* @var $dataProvider */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-index">

    <div class="jumbotron">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php if (!Yii::$app->user->isGuest): ?>
            <?=Html::a('Создать', ['/category/create'], ['class' => 'btn btn-success'])?>
        <?php endif; ?>
    </div>

    <div class="body-content">
        <?php if ($dataProvider->getModels()): ?>
            <div class="row">
                <?php foreach ($dataProvider->getModels() as $model): ?>
                    <div class="col-sm-6">
                        <?=$this->render('_view', ['model' => $model, 'short' => true])?>
                    </div>
                <?php endforeach; ?>
            </div>

            <?= LinkPager::widget([
                'pagination' => $dataProvider->pagination,
            ]); ?>

        <?php else: ?>
            <div class="alert alert-danger">Нет категорий</div>
        <?php endif; ?>

    </div>
</div>
