<?php
/**
 * Форма проекта
 * @var $this yii\web\View
 * @var app\models\form\ProjectForm $model
 * @var array $positionsArray
 */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>


<?php if (Yii::$app->session->hasFlash('danger')): ?>
    <div class="alert alert-danger">
        <?=Yii::$app->session->getFlash('danger') ?>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?=Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<?php $form = ActiveForm::begin(['id' => 'form-project']); ?>

<div class="row">
    <div class="col-lg-5">
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'description')->textarea() ?>
        <?= $form->field($model, 'status')->dropDownList($model->getStatusArray()) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'button-save']) ?>
        </div>

    </div>

    <?php if ($model->scenario == 'user-update'): ?>
        <div class="col-lg-5">
            <h3>Должности:</h3>
            <?php if ($model->node) : ?>
                <ol>
                    <?php foreach ($model->node as $node) : ?>
                        <li>
                            <span class="remove-position glyphicon glyphicon-remove"></span>
                            <?=Html::encode($node['position']['name'])?> - <?=Html::encode($node['user']['name'])?>
                            <?=Html::activeHiddenInput($model, 'position[]', [
                                'value' => $node['position_id']
                            ])?>
                            <?=Html::activeHiddenInput($model, 'user[]', [
                                'value' => $node['user_id']
                            ])?>
                        </li>
                    <?php endforeach; ?>
                </ol>
                <?=Html::error($model, 'position', ['class' => 'help-block'])?>
            <?php else: ?>
                <div class="alert alert-warning">Нет должностей</div>
            <?php endif; ?>

            <div class="form-group<?=(isset($model->getErrors('position')[0])) ? ' has-error' : ''?>">
                <div id="positions">
                    <div class="position row">
                        <div class="col-lg-5">
                            <?=Html::activeTextInput($model, 'user[]', [
                                'class' => 'form-control',
                                'placeholder' => 'Имя пользователя'
                            ])?>
                        </div>
                        <div class="row col-lg-6">
                            <?=Html::activeDropDownList($model, 'position[]', $positionsArray, [
                                'class' => 'form-control',
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="help-block">Внимание: неизвестные имена будут проигнорированы.</div>
                <?php
                    if (isset($model->getErrors('position')[0])) {
                        echo Html::tag('div', $model->getErrors('position')[0], ['class' => 'text-danger']);
                    }
                ?>
            </div>

            <?= Html::button('Добавить должность', ['class' => 'btn btn-default', 'name' => 'button-add-position', 'id' => 'add-position']) ?>
        </div>

    <?php endif; ?>

</div>
<?php ActiveForm::end(); ?>