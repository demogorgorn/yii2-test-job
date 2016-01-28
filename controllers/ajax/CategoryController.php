<?php

namespace app\controllers\ajax;

use app\models\Category;
use yii\web\Response;
use yii\db\Query;
use Yii;

/**
 * Book Controller
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
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Все
     *
     * @param null $q
     * @param null $id
     * @return array
     */
    public function actionIndex($q = null, $id = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, name')
                ->from(Category::tableName())
                ->where(['like', 'name', $q])
                ->andWhere(['status' => Category::STATUS_ACTIVE])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $categories = [];
            foreach ($data as &$category) {
                $categories[] = ['id' => $category['id'], 'text' => $category['name']];
            }
            $out['results'] = $categories;
        } else if ($id > 0) {
            $category = Category::findById($id, Category::STATUS_ACTIVE);
            if ($category) {
                $out['results'] = ['id' => $category->id, 'text' => $category->name];
            }
        }
        return $out;
    }
}