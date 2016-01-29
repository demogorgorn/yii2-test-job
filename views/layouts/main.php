<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>



<?php yii\widgets\Pjax::begin(['id' => 'site']) ?>


<div class="wrap">

    <?php
    NavBar::begin([
        'brandLabel' => 'Онлайн Библиотека',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $user = [
        ['label' => 'Регистрация', 'url' => ['/user/signup']],
        ['label' => 'Вход', 'url' => ['/user/signin']],
    ];
    if (!Yii::$app->user->isGuest) {
        $user = [
            ['label' => Yii::$app->user->identity->email, 'url' => ['/user/profile']],
            ['label' => 'Выход', 'url' => ['/user/logout']],
        ];
    }
    $items = array_merge([
        ['label' => 'Книги', 'url' => ['/book/index']],
        ['label' => 'Категории', 'url' => ['/category/index']],
        ['label' => 'Авторы', 'url' => ['/user/index']],
        ['label' => 'О нас', 'url' => ['/site/about']],
    ], $user);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>


    <div class="container">

        <?php yii\widgets\Pjax::begin(['id' => 'breadcrumbs']) ?>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        <?php yii\widgets\Pjax::end() ?>

            <?php if (Yii::$app->session->hasFlash('danger')): ?>
                <div class="alert alert-danger">
                    <?= Yii::$app->session->getFlash('danger') ?>
                </div>
            <?php endif; ?>

            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success">
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>

            <div id="reload">
                <?= $content ?>
            </div>
    </div>



</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= date('Y') ?></p>
        <p class="pull-right"><?= str_replace('Yii' , 'Yii2', Yii::powered()) ?></p>
    </div>
</footer>

<?php yii\widgets\Pjax::end() ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
