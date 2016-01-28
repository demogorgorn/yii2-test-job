<?php

namespace app\controllers;

use app\models\Book;
use app\models\search\BookSearch;
use app\models\form\BookForm;
use yii\base\Exception;
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
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = new BookForm(['scenario' => 'create']);
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->validate()) {
                    if ($model->create()) {
                        $this->flash('success-save');
                    } else {
                        $this->flash(false);
                        throw new Exception;
                    }
                }
                $transaction->commit();
                return $this->redirect(['/book/index']);
            } catch (\Exception $e) {
                $transaction->rollBack();
                $this->flash(false);
                return $this->refresh();
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
        $model = new BookForm(['scenario' => 'update', 'id' => $book->id]);
        $model->setAttributes($book->getAttributes(), false);
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->validate()) {
                    if ($model->update($book)) {
                        $this->flash('success-save');
                    } else {
                        $this->flash(false);
                    }
                }
                $transaction->commit();
                return $this->refresh();
            } catch (\Exception $e) {
                $transaction->rollBack();
                $this->flash(false);
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
            $this->flash('success-delete');
        } else {
            $this->flash(false);
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

    /**
     * Уведомление
     *
     * @param string $action
     */
    protected function flash($action)
    {
        if ($action == 'success-save') {
            Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
        } else if ($action == 'success-delete') {
            Yii::$app->session->setFlash('success', 'Данные успешно удалены.');
        } else {
            Yii::$app->session->setFlash('danger', 'Возникла ошибка сохранения данных, пожалуйста попробуйте еще раз.');
        }
    }
}
