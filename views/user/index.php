<?php

/* @var $this yii\web\View */
/* @var $dataProvider */

use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\BookHelper;
use yii\widgets\LinkPager;

$this->title = 'Авторы';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-index">

    <div class="jumbotron">
        <h1>Авторы</h1>
    </div>

    <div class="body-content">
        <?php if ($dataProvider->getModels()):
            $countModels = count($dataProvider->getModels());
            ?>
            <div class="row">
                <?php foreach ($dataProvider->getModels() as $key => $model): ?>

                    <?php if ($key % 2 == 0): ?>
                        <div class="row">
                    <?php endif; ?>

                        <div class="col-sm-6">
                            <?=$this->render('_view', ['model' => $model, 'short' => true])?>
                        </div>

                    <?php if ($key % 2 || ($key+1) == $countModels): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?= LinkPager::widget([
                'pagination' => $dataProvider->pagination,
            ]); ?>
        <?php else: ?>
            <div class="alert alert-danger">Нет авторов</div>
        <?php endif; ?>

    </div>
</div>
