<?php

namespace app\controllers;

use app\models\Book;
use app\models\search\BookSearch;
use app\models\form\BookForm;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * Book Controller
 * @package app\controllers
 */
class BookController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
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
        $searchModel = new BookSearch();
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
        $model = Book::findById($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Создать книгу
     *
     * @return string|\yii\web\Response
     */
    /*public function actionCreate()
    {
        $model = new BookForm();
        if ($model->load(Yii::$app->request->post()) && $model->create()) {
            return $this->goHome();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }*/
}
