<?php

/* @var $this yii\web\View */
/* @var app\models\form\CategoryForm $model */

$this->title = 'Редактировать категорию';

use yii\helpers\Url;
use yii\helpers\Html;
?>


<div class="jumbotron">
    <h1><?=Html::encode($this->title)?></h1>
</div>


<?= $this->render('_form', [
    'model' => $model
]); ?>

