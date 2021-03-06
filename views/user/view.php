<?php

/* @var $this yii\web\View */
/* @var app\models\Book $model */

use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\BookHelper;
use yii\widgets\LinkPager;

$this->title = 'Пользователь';
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['/user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-index">

    <div class="jumbotron">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="body-content">
        <div class="col-sm-6 col-centered">
            <?=$this->render('_view', ['model' => $model])?>
        </div>
    </div>

</div>
