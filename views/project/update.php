<?php

/**
 * Редактировать проект
 * @var $this yii\web\View
 * @var app\models\form\ProjectForm $model
 * @var array $positionsArray
 */
$this->title = 'Редактировать проект';

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>


<div class="jumbotron">
    <h1>Редактировать проект</h1>
</div>

<p>Для того, чтобы создать редактировать проект заполните ниже представленную форму:</p>

<?= $this->render('_form', [
    'model' => $model,
    'positionsArray' => $positionsArray,
]); ?>