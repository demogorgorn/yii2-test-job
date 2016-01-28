<?php

/* @var $this yii\web\View */
/* @var app\models\form\CategoryForm $model */

$this->title = 'Создать новую категорию';

use yii\helpers\Url;
use yii\helpers\Html;
?>


<div class="jumbotron">
    <h1><?=Html::encode($this->title)?></h1>
</div>


<p class="text-center">Для того, чтобы создать новую категорию заполните ниже представленную форму:</p>

<?= $this->render('_form', [
    'model' => $model
]); ?>

