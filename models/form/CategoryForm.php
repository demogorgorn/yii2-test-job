<?php

namespace app\models\form;

use app\models\Category;
use yii\base\Model;
use Yii;

/**
 * Category Form
 * @package app\models\form
 */
class CategoryForm extends Model
{
    /**
     * @var string
     */
    public $name;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge((new Category())->attributeLabels(), [

        ]);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'create' => ['name'],
            'update' => ['name'],
            'delete' => [],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 32],
            ['name', 'match', 'pattern' => '/^([а-яА-ЯЁёa-zA-Z0-9\s_-]+)$/u'],
        ];
    }

    /**
     * Создать
     *
     * @return bool|null
     */
    public function create()
    {
        $model = new Category();
        $model->name = $this->name;
        $model->status = Category::STATUS_ACTIVE;

        return $model->save();
    }

    /**
     * Редактировать
     *
     * @param Category $model
     * @return null
     */
    public function update(Category $model)
    {
        $model->name = $this->name;

        return $model->save();
    }

    /**
     * Удалить
     *
     * @param Category $model
     * @return null
     */
    public function delete(Category $model)
    {
        $model->status = Category::STATUS_DELETE;

        return $model->save();
    }
}