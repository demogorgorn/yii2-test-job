<?php

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('Index');
$I->amOnPage('/');
$I->see('Управление проектами', 'h1');
$I->see('Последние проекты', 'h2');
$I->see('Должности', 'h2');


$I->see('Программист', 'li');
$I->see('Дизайнер', 'li');
$I->see('Руководитель проекта', 'li');
$I->see('Тестировщик', 'li');
$I->see('Архитектор баз данных', 'li');
$I->see('Пиарщик', 'li');
$I->see('Парень, который ничего не делает', 'li');
