<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\form\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Редактировать профиль';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-profile', 'options' => ['data-pjax' => true ]]); ?>

            <?= $form->field($model, 'email')->textInput(['type' => 'email', 'disabled' => 'disabled']) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'repassword')->passwordInput() ?>

            <?= $form->field($model, 'avatar')->fileInput() ?>

            <div class="clear">
                <div class="user-avatar" style="background-image: url(<?=Yii::$app->user->identity->getAvatar()?>)"></div>
            </div>

            <?= $form->field($model, 'about_me')->textarea() ?>

            <div class="form-group">
                <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>