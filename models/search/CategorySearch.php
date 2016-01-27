<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\Category;
use yii\base\Model;
use Yii;

/**
 * Category Search
 * @package app\models\search
 */
class CategorySearch extends Model
{
    /**
     * Создает экземпляр ActiveDataProvider с поисковым запросом
     *
     * @return ActiveDataProvider
     */
    public function search()
    {
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'defaultPageSize' => 10,
            ],
        ]);

        return $dataProvider;
    }
}