<?php

namespace app\models\scope;

use app\models\Project;
use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * Class ProjectQuery
 * @package app\models\scopes
 */
class ProjectQuery extends ActiveQuery
{
    /**
     * @param int $state
     * @return $this
     */
    public function status($state = 1)
    {
        $this->andWhere(Project::tableName() . '.status = ' . $state);
        return $this;
    }
}