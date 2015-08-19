<?php

/**
 * Главная страница
 * @var $this yii\web\View
 * @var app\models\search\ProjectSearch $dataProvider
 */
$this->title = 'Управление проектами';

use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\ProjectHelper;
use yii\widgets\LinkPager;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Проекты</h1>
        <p><a class="btn btn-lg btn-success" href="<?=Url::toRoute(['/project/create'])?>">Создать проект</a></p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <h2>Все проекты:</h2>

                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?=Yii::$app->session->getFlash('success') ?>
                    </div>
                <?php endif; ?>

                <?php if ($dataProvider->getModels()): ?>
                    <?php foreach ($dataProvider->getModels() as $model): ?>
                        <div class="list-group">
                            <?=ProjectHelper::getStatus($model->status)?>
                            <div class="list-group-item clearfix">
                                <h4 class="list-group-item-heading"><?=ProjectHelper::getName($model->name)?></h4>
                                <p class="list-group-item-text"><?=ProjectHelper::getDescription($model->description)?></p>
                                <br/>
                                <p class="list-group-item-text">
                                    <small class="text-primary pull-left"><?=ProjectHelper::getPositions([])?></small>
                                    <a href="<?=Url::toRoute(['/project/update', 'id' => $model->id])?>" class="pull-right">Редактировать проект</a>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?=LinkPager::widget([
                        'pagination' => $dataProvider->pagination,
                    ]);?>

                <?php else: ?>
                    <div class="alert alert-danger">Нет проектов</div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
