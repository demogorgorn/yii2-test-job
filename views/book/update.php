<?php

/* @var $this yii\web\View*/
/* @var app\models\form\BookForm $model*/

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Редактировать книгу';
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['/book/index']];
$this->params['breadcrumbs'][] = Html::encode($model->name);
?>


<div class="jumbotron">
    <h1><?=Html::encode($this->title)?></h1>
</div>


<?= $this->render('_form', [
    'model' => $model
]); ?>

