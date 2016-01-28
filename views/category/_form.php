<?php
/**
 * @var $this yii\web\View
 * @var app\models\form\CategoryForm $model
 */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin(['id' => 'form-category', 'options' => ['data-pjax' => true ]]); ?>

<div class="row">
    <div class="col-lg-5 col-centered">
        <?= $form->field($model, 'name') ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'button-save']) ?>
        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>