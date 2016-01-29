<?php

namespace app\components;

use Yii;

/**
 * Controller
 * @package app\components
 */
class Controller extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function render($view, $params = [])
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax($view, $params);
        }
        return parent::render($view, $params);
    }
}
