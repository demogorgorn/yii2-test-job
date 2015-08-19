<?php

namespace app\controllers;

use app\models\Position;
use app\models\search\ProjectSearch;
use app\models\form\PositionForm;
use app\models\form\ProjectForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Контроллер для управления проектами
 * @package app\controllers
 */
class ProjectController extends Controller
{
    /**
     * Все
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $projectDataProvider = $searchModel->indexSearch();

        return $this->render('index', [
            'dataProvider' => $projectDataProvider,
        ]);
    }

    /**
     * Создать
     * @return string
     */
    public function actionCreate()
    {
        $model = new ProjectForm(['scenario' => 'user-create']);

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->validate()) {
                if ($model->createProject()) {
                    Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
                    return $this->redirect(['project/update', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('danger', 'Возникла критическая ошибка');
                }
                return $this->refresh();
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Редактировать
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = ProjectForm::findById($id, null);

        if (!$model) {
            throw new NotFoundHttpException("Проекта №{$id} нет в базе данных");
        }

        $model->setScenario('user-update');

        $positionsArray = Position::findAllArray();
        $positionsArray = ArrayHelper::map($positionsArray, 'id', 'name');

        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());
            if ($model->validate()) {
                if ($model->updateProject()) {
                    Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
                } else {
                    Yii::$app->session->setFlash('danger', 'Возникла критическая ошибка');
                }
                return $this->refresh();
            }
        }

        return $this->render('update', [
            'model' => $model,
            'positionsArray' => $positionsArray,
        ]);
    }
}
