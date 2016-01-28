<?php

namespace app\controllers\ajax;

use app\models\User;
use yii\web\Response;
use yii\db\Query;
use Yii;

/**
 * User Controller
 * @package app\controllers
 */
class UserController extends \yii\web\Controller
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
        $out = ['results' => ['id' => '', 'name' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, name, surname')
                ->from(User::tableName())
                ->where(['like', 'name', $q])
                ->orWhere(['like', 'surname', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $users = [];
            foreach ($data as &$user) {
                $users[] = ['id' => $user['id'], 'name' => $user['name'] . ' ' . $user['surname']];
            }
            $out['results'] = $users;
        } else if ($id > 0) {
            $user = User::findIdentity($id);
            if ($user) {
                $out['results'] = ['id' => $user->id, 'name' => $user->name . ' ' . $user->surname];
            }
        }
        return $out;
    }
}
