<?php

namespace app\models\node;

use app\models\Position;
use app\models\User;
use yii\web\HttpException;
use yii\db\ActiveRecord;
use Yii;

/**
 * Связь между проектом должностью и пользователем
 * @package app\models\node
 */
class ProjectPositionUser extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%projects_positions}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}