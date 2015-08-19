<?php

/**
 * Создать новый проект
 * @var $this yii\web\View
 * @var app\models\form\ProjectForm $model
 */
$this->title = 'Создать новый проект';

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<div class="jumbotron">
    <h1>Создать новый проект</h1>
</div>


<p>Для того, чтобы создать новый проект заполните ниже представленную форму:</p>

<?= $this->render('_form', [
    'model' => $model
]); ?>

