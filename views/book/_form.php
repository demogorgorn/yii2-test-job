<?php
/**
 * @var $this yii\web\View
 * @var app\models\form\BookForm $model
 */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\web\JsExpression;
?>

<?php $form = ActiveForm::begin(['id' => 'form-book', 'options' => ['data-pjax' => true ]]); ?>

<div class="row">
    <div class="col-lg-5 col-centered">
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'description')->textarea() ?>
        <?= $form->field($model, 'cover') ?>
        <?= $form->field($model, 'file') ?>




        <?= $form->field($model, 'categories')->widget(Select2::classname(), [
            'options' => ['placeholder' => null, 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10,
                'ajax' => [
                    'url' => Url::to(['/ajax/category/index']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(category) { return category.name; }'),
                'templateSelection' => new JsExpression('function (category) { return category.name; }'),
            ],
        ]); ?>
        <?= $form->field($model, 'users')->widget(Select2::classname(), [
            'options' => ['placeholder' => null, 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10,
                'ajax' => [
                    'url' => Url::to(['/ajax/user/index']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(user) { return user.name; }'),
                'templateSelection' => new JsExpression('function (user) { return user.name; }'),
            ],
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'button-save']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>