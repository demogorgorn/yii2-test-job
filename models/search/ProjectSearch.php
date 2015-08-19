<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\Project;
use yii\base\Model;
use Yii;

/**
 * Class ProjectSearch
 * @package app\models\search
 */
class ProjectSearch extends Model
{
    /**
     * Создает экземпляр ActiveDataProvider с поисковым запросом
     *
     * @return ActiveDataProvider
     */
    public function indexSearch()
    {
        $query = Project::find()
            ->with(['node'])
            ->limit(7);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_DESC,
                    'time_create' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'defaultPageSize' => 10,
            ]
        ]);

        return $dataProvider;
    }

    /**
     * Создает экземпляр ActiveDataProvider с поисковым запросом
     *
     * @return ActiveDataProvider
     */
    public function search()
    {
        $query = Project::find()
            ->with(['node'])
            ->limit(7);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_DESC,
                    'time_create' => SORT_DESC,
                ],
            ],
            'pagination' => false
        ]);

        return $dataProvider;
    }
}