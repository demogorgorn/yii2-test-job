<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Class UserSearch
 * @package app\models\search
 */
class UserSearch extends Model
{
    /**
     * Создает экземпляр ActiveDataProvider с поисковым запросом
     *
     * @return ActiveDataProvider
     */
    public function search()
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'defaultPageSize' => 10,
            ]
        ]);

        return $dataProvider;
    }
}