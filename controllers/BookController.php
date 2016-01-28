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
        $model = new BookForm(['scenario' => 'create']);
        if ($model->load(Yii::$app->request->post())) {

            echo '<pre>';
            print_r($_POST);


            die();

            if ($model->validate()) {
                if ($model->create()) {
                    Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
                    return $this->redirect(['/book/index']);
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
        $model = new BookForm(['scenario' => 'update']);
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
        $model = new BookForm(['scenario' => 'delete']);
        if ($model->delete($book)) {
            Yii::$app->session->setFlash('success', 'Данные успешно удалены');
        } else {
            Yii::$app->session->setFlash('danger', 'Возникла ошибка удаления данных, пожалуйста попробуйте еще раз.');
        }
        return $this->redirect(['/book/index']);
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
        $model = Book::findById($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }
        return $model;
    }
}
