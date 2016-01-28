<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\Book;
use yii\base\Model;
use Yii;

/**
 * Book Search
 * @package app\models\search
 */
class BookSearch extends Model
{
    /**
     * Создает экземпляр ActiveDataProvider с поисковым запросом
     *
     * @return ActiveDataProvider
     */
    public function search()
    {
        $query = Book::find()
            ->status();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date_create' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'defaultPageSize' => 10,
            ],
        ]);

        return $dataProvider;
    }
}