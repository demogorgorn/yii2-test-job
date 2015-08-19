<?php

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('Create Project');
$I->amOnPage('/project/create');
$I->see('Создать новый проект', 'h1');

if (method_exists($I, 'wait')) {
    $I->wait(3);
}

// Тест валидаторов
$I->click('Сохранить');
$I->see('Необходимо заполнить «Название».');
$I->see('Необходимо заполнить «Описание».');

if (method_exists($I, 'wait')) {
    $I->wait(3);
}


// Тест ввода данных
$I->fillField('ProjectForm[name]', 'Новый проект');
$I->fillField('ProjectForm[description]', 'Описание');
$I->selectOption('ProjectForm[status]','Открыт');
$I->click('Сохранить');


if (method_exists($I, 'wait')) {
    $I->wait(3);
}

$I->dontSeeElement('#form-project');
$I->see('Данные успешно сохранены');
