<?php

/* @var $this yii\web\View*/
/* @var app\models\form\BookForm $model*/

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Создать новую книгу';
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['/book/index']];
$this->params['breadcrumbs'][] = 'Создать';
?>


<div class="jumbotron">
    <h1><?=Html::encode($this->title)?></h1>
</div>


<p class="text-center">Для того, чтобы создать новую книгу заполните ниже представленную форму:</p>

<?= $this->render('_form', [
    'model' => $model
]); ?>

