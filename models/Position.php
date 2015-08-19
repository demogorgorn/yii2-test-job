<?php

namespace app\models;

use yii\web\HttpException;
use yii\db\ActiveRecord;
use Yii;

/**
 * Должность
 * @package app\models
 */
class Position extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%positions}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'name' => 'Название',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findAllArray()
    {
        return static::find()->asArray()->all();
    }
}