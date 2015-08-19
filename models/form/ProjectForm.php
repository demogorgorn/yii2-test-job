<?php

namespace app\models\form;

use app\models\node\ProjectPositionUser;
use app\models\Position;
use app\models\User;
use app\models\Project;
use Yii;

/**
 * Форма создания и редактирования проекта
 * @package app\models\form
 */
class ProjectForm extends \app\models\Project
{
    /**
     *
     * @var array
     */
    public $position = [];

    /**
     *
     * @var array
     */
    public $user = [];

    /**
     * Верифицированные
     * Должность - Пользователь
     * @var array
     */
    private $_verifyPositions = [];

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'time_create',
                'updatedAtAttribute' => 'time_update',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'status'], 'required'],
            ['status', 'in', 'range' => array_keys($this->getStatusArray())],
            [['name'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 5000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function transactions()
    {
        return [
            'user-create' => self::OP_ALL,
            'user-update' => self::OP_ALL,
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'user-create' => ['name', 'description', 'status'],
            'user-update' => ['name', 'description', 'status', 'position', 'user'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

            if ($this->scenario == 'user-update') {
                // Верификация должностей и пользователей
                foreach($this->position as $key => $positionId) {
                    if (!isset($this->user[$key])) {
                        continue;
                    }
                    if (!$position = Position::findOne($positionId)) {
                        continue;
                    }
                    if (is_numeric($this->user[$key])) {
                        $user = User::findIdentity($this->user[$key]);
                    } else {
                        $user = User::findByUsername(trim($this->user[$key]));
                    }
                    if (!$user) {
                        continue;
                    }
                    $this->_verifyPositions[] = [
                        'positionId' => $position->id,
                        'userId' => $user->id
                    ];
                }
                if (empty($this->_verifyPositions)) {
                    $this->addError('position', 'Вы должны указать минимум одну должность');
                }
            }
            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($this->scenario == 'user-update') {

                $nodes = $this->getNodes();
                $nodesOpt = $nodes;
                $verifyPositionsOpt = $this->_verifyPositions;

                // Удалить не нужные узлы
                foreach($nodes as &$node) {

                    $hasDeleteNode = true;

                    foreach ($verifyPositionsOpt as $key => &$verifyPositionOpt) {
                        if ($verifyPositionOpt['positionId'] == $node['position_id'] && $verifyPositionOpt['userId'] == $node['user_id']) {
                            unset($verifyPositionsOpt[$key]);
                            $hasDeleteNode = false;
                            break;
                        }
                    }

                    if ($hasDeleteNode) {
                        $this->deleteNode($node['position_id'], $node['user_id']);
                    }
                }

                // Добавить новые узлы
                foreach ($this->_verifyPositions as &$node) {

                    $hasNewNode = true;

                    foreach($nodesOpt as $key => &$nodeOpt) {
                        if ($node['positionId'] == $nodeOpt['position_id'] && $node['userId'] == $nodeOpt['user_id']) {
                            unset($nodesOpt[$key]);
                            $hasNewNode = false;
                            break;
                        }
                    }

                    if ($hasNewNode) {
                        $newNode = new ProjectPositionUser();
                        $newNode->project_id = $this->id;
                        $newNode->position_id = $node['positionId'];
                        $newNode->user_id = $node['userId'];
                        $newNode->save(false);
                    }
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Создать новый проект
     * @return bool
     */
    public function createProject()
    {
        return $this->save(false);
    }

    /**
     * Редактировать проект
     * @return bool
     */
    public function updateProject()
    {
        return $this->save(false);
    }

    /**
     * Вернуть все узлы
     * @return mixed
     */
    private function getNodes()
    {
        $node = $this->getNode();
        $node->joinWith = null;
        return $node->all();
    }

    /**
     * Удалить узел
     * @param $position_id
     * @param $user_id
     * @return false|int
     * @throws \Exception
     */
    private function deleteNode($position_id, $user_id)
    {
        $nodeModel = ProjectPositionUser::find()
            ->where('project_id=:project_id AND position_id=:position_id AND user_id=:user_id', [
                'project_id' => $this->id,
                'position_id' => $position_id,
                'user_id' => $user_id,
            ])->one();
        return $nodeModel->delete();
    }
}
