<?php

namespace app\models;

use app\models\node\ProjectPositionUser;
use app\models\scope\ProjectQuery;
use yii\web\HttpException;
use yii\db\ActiveRecord;
use Yii;

/**
 * Проект
 * @package app\models
 */
class Project extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%projects}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'name' => 'Название',
            'description' => 'Описание',
            'status' => 'Статус',
            'time_create' => 'Дата старта',
            'time_update' => 'Дата редактирования',
        ];
    }

    /**
     * Данные статуса
     * - Открыт
     * - Завершен
     */
    const STATUS_ACTIVE = 1;
    const STATUS_CLOSE = 0;

    /**
     * Массив доступных данных статуса
     * @return array
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_ACTIVE => 'Открыт',
            self::STATUS_CLOSE => 'Завершен',
        ];
    }

    /**
     * Поиск по идентификатуру
     * @param $id
     * @param int $status
     * @return array|null|ActiveRecord
     */
    public static function findById($id, $status = 1)
    {
        $query = static::find();
        $query->where(['id' => $id]);

        if ($status !== null) {
            $query->status($status);
        }
        return $query->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getPositions()
    {
        return $this->hasMany(Position::className(), ['id' => 'position_id'])->viaTable('{{projects_positions}}', ['project_id' => 'id']);
    }*/

    /**
     * @return $this
     */
    public function getNode()
    {
        return $this->hasMany(ProjectPositionUser::className(), ['project_id' => 'id'])->joinWith([
            'user',
            'position',
        ])->select(['project_id', 'position_id', 'user_id'])->asArray();
    }

}