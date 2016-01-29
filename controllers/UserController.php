<?php

namespace app\controllers;

use app\models\search\UserSearch;
use app\models\form\ProfileForm;
use app\models\form\LoginForm;
use app\models\form\SignupForm;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\User;
use Yii;

/**
 * User Controller
 * @package app\controllers
 */
class UserController extends \app\components\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => [],
                'rules' => [
                    [
                        'actions' => ['signup', 'signin'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@', '?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Все
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Просмотр
     *
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = User::findIdentity($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Регистрация
     *
     * @return string|\yii\web\Response
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Авторизация
     *
     * @return string|\yii\web\Response
     */
    public function actionSignin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Профиль
     *
     * @return string|\yii\web\Response
     */
    public function actionProfile()
    {
        $model = new ProfileForm();
        $model->setAttributes(Yii::$app->user->identity->getAttributes(), false);
        if ($model->load(Yii::$app->request->post())) {
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            if ($model->validate()) {
                if ($model->update(Yii::$app->user->identity)) {
                    Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
                } else {
                    Yii::$app->session->setFlash('danger', 'Возникла ошибка сохранения данных, пожалуйста попробуйте еще раз.');
                }
                return $this->refresh();
            }
        }
        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    /**
     * Выход
     *
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
