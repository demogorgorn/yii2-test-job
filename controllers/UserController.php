<?php

namespace app\controllers;

use app\models\search\UserSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends Controller
{
    /**
     * Все 
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
}
