<?php

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('Update Project');
$I->amOnPage('/project/update/1');
$I->see('Редактировать проект', 'h1');


// Тест ввода данных
$I->expectTo('Ввод данных');
$I->fillField('ProjectForm[name]', 'Новый проект [Р]');
$I->fillField('ProjectForm[description]', 'Описание [Р]');
$I->selectOption('ProjectForm[status]','Открыт');
$I->click('Сохранить');


if (method_exists($I, 'wait')) {
    $I->wait(3);
}

$I->dontSeeElement('#form-project');
$I->see('Данные успешно сохранены');
