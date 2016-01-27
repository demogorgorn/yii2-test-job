<?php

namespace app\controllers;

use app\models\Category;
use app\models\search\CategorySearch;
use app\models\form\CategoryForm;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * Category Controller
 * @package app\controllers
 */
class CategoryController extends \yii\web\Controller
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
        $searchModel = new CategorySearch();
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
        $model = Category::findById($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Добавить объявление
     *
     * @return string|\yii\web\Response
     */
    /*public function actionCreate()
    {
        $model = new CategoryForm();
        if ($model->load(Yii::$app->request->post()) && $model->create()) {
            return $this->goHome();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }*/
}
