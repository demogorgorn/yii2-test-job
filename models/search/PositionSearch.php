<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\Position;
use yii\base\Model;
use Yii;

/**
 * Class PositionSearch
 * @package app\models\search
 */
class PositionSearch extends Model
{
    /**
     * Создает экземпляр ActiveDataProvider с поисковым запросом
     *
     * @return ActiveDataProvider
     */
    public function search()
    {
        $query = Position::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC,
                ],
            ],
            'pagination' => false,
        ]);

        return $dataProvider;
    }
}