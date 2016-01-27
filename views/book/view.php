<?php

/* @var $this yii\web\View */
/* @var app\models\Book $model */

use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\CategoryHelper;
use app\helpers\UserHelper;
use yii\widgets\LinkPager;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['/book/index']];
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
