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
    public function rules()
    {
        return [

        ];
    }


    public function create()
    {
        if (!$this->validate()) {
            return null;
        }

        $model = new Category();
        //$model->name = ;

        die();
    }
}