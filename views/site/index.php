<?php

/**
 * Главная страница
 * @var $this yii\web\View
 * @var app\models\search\ProjectSearch $projectDataProvider
 * @var app\models\search\PositionSearch $positionDataProvider
 */
$this->title = 'Управление проектами';

use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\ProjectHelper;
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Управление проектами</h1>
        <p><a class="btn btn-lg btn-success" href="<?=Url::toRoute(['/project/create'])?>">Создать проект</a></p>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-8">
                <h2>Последние проекты:</h2>
                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?=Yii::$app->session->getFlash('success') ?>
                    </div>
                <?php endif; ?>
                <?php if ($projectDataProvider->getModels()): ?>
                    <?php foreach ($projectDataProvider->getModels() as $model): ?>
                        <div class="list-group">
                            <?=ProjectHelper::getStatus($model->status)?>
                            <div class="list-group-item clearfix">
                                <h4 class="list-group-item-heading"><?=ProjectHelper::getName($model->name)?></h4>
                                <p class="list-group-item-text"><?=ProjectHelper::getDescription($model->description)?></p>
                                <br/>
                                <p class="list-group-item-text">
                                    <span class="text-primary pull-left"><?=ProjectHelper::getPositions($model->node)?></span>
                                    <a href="<?=Url::toRoute(['/project/update', 'id' => $model->id])?>" class="pull-right">Редактировать проект</a>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-danger">Нет проектов</div>
                <?php endif; ?>
                <p><a class="btn btn-default" href="<?=Url::toRoute(['/project/index'])?>">Все проекты &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Должности:</h2>
                <?php if ($positionDataProvider->getModels()): ?>
                    <ol>
                        <?php foreach ($positionDataProvider->getModels() as $model): ?>
                            <li><?=$model->name?></li>
                        <?php endforeach; ?>
                    </ol>
                <?php else: ?>
                    <div class="alert alert-danger">Нет проектов</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>