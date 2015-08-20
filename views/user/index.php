<?php

/**
 * Все пользователи
 * @var $this yii\web\View
 * @var app\models\search\UserSearch $dataProvider
 */
$this->title = 'Управление проектами';

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Пользователи</h1>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <h2>Все пользователи:</h2>

                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?=Yii::$app->session->getFlash('success') ?>
                    </div>
                <?php endif; ?>

                <?php if ($dataProvider->getModels()): ?>
                    <?php foreach ($dataProvider->getModels() as $model): ?>
                        <div class="list-group">
                            <div class="list-group-item clearfix">
                                <h4 class="list-group-item-heading"><?=$model->name?></h4>
                                <hr style="margin: 0 0 5px 0" />
                                <p class="list-group-item-text">
                                    <?php
                                        if ($model->countProjects) {
                                            echo 'Пользователь принял участие в ' . \Yii::t(
                                                'app',
                                                '{n, plural,  one{# проекте} few{# проектах} many{# проектах} other{# проектах}}',
                                                ['n' => $model->countProjects]
                                            );
                                        } else {
                                            echo Html::tag('span', 'Пользователь не принимал участия в проектах', ['style' => 'color: silver']);
                                        }
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?=LinkPager::widget([
                        'pagination' => $dataProvider->pagination,
                    ]);?>

                <?php else: ?>
                    <div class="alert alert-danger">Нет пользователей</div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>