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
                'only' => [],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete'],
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Создать
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CategoryForm(['scenario' => 'create']);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->create()) {
                    Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
                    return $this->redirect(['/category/index']);
                } else {
                    Yii::$app->session->setFlash('danger', 'Возникла ошибка сохранения данных, пожалуйста попробуйте еще раз.');
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Редактировать
     *
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $book = $this->findModel($id);
        $model = new CategoryForm(['scenario' => 'update']);
        $model->setAttributes($book->getAttributes(), false);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->update($book)) {
                    Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
                } else {
                    Yii::$app->session->setFlash('danger', 'Возникла ошибка сохранения данных, пожалуйста попробуйте еще раз.');
                }
                return $this->refresh();
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Удалить
     *
     * @return string|\yii\web\Response
     */
    public function actionDelete($id)
    {
        $book = $this->findModel($id);
        $model = new CategoryForm(['scenario' => 'delete']);
        if ($model->delete($book)) {
            Yii::$app->session->setFlash('success', 'Данные успешно удалены');
        } else {
            Yii::$app->session->setFlash('danger', 'Возникла ошибка удаления данных, пожалуйста попробуйте еще раз.');
        }
        return $this->redirect(['/category/index']);
    }

    /**
     * Поиск модели
     *
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $model = Category::findById($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }
        return $model;
    }
}
