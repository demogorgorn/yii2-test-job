<?php

namespace app\models\form;

use app\models\Book;
use yii\base\Model;
use Yii;

/**
 * Book Form
 * @package app\models\form
 */
class BookForm extends Model
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $cover;

    /**
     * @var string
     */
    public $file;

    /**
     * @var array
     */
    public $categories;

    /**
     * @var array
     */
    public $users;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge((new Book())->attributeLabels(), [
            'categories' => 'Категории',
            'users' => 'Авторы',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'create' => ['name', 'description', 'cover', 'file'],
            'update' => ['name', 'description', 'cover', 'file'],
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

            ['description', 'required'],
            ['description', 'string'],

            ['cover', 'required'],
            ['cover','url'],

            ['file', 'required'],
            ['file','url'],
        ];
    }

    /**
     * Создать
     *
     * @return bool|null
     */
    public function create()
    {
        $model = new Book();
        $model->name = $this->name;
        $model->description = $this->description;
        $model->cover = $this->cover;
        $model->file = $this->file;
        $model->status = Book::STATUS_ACTIVE;
        $model->date_create = date('Y-m-d H:i:s');
        $model->date_update = date('Y-m-d H:i:s');

        return $model->save();
    }

    /**
     * Редактировать
     *
     * @param Book $model
     * @return null
     */
    public function update(Book $model)
    {
        $model->name = $this->name;
        $model->description = $this->description;
        $model->cover = $this->cover;
        $model->file = $this->file;
        $model->date_update = date('Y-m-d H:i:s');

        return $model->save();
    }

    /**
     * Удалить
     *
     * @param Book $model
     * @return null
     */
    public function delete(Book $model)
    {
        $model->status = Book::STATUS_DELETE;

        return $model->save();
    }
}