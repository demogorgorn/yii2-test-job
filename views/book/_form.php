<?php
/**
 * Форма
 * @var $this yii\web\View
 * @var app\models\form\BookForm $model
 */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(['id' => 'form-book', 'options' => ['data-pjax' => true ]]); ?>

<div class="row">
    <div class="col-lg-5">
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'description')->textarea() ?>

        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'button-save']) ?>
        </div>

    </div>

    <div class="col-lg-5">
        <h3>Добавить фото:</h3>


        <?= Html::button('----', ['class' => 'btn btn-default', 'name' => 'button-add-position', 'id' => 'add-position']) ?>
    </div>


</div>
<?php ActiveForm::end(); ?>