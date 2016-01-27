<?php

namespace app\models\form;

use app\models\Category;
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