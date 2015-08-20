<?php

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('All Projects');
$I->amOnPage('/projects');
$I->see('Проекты', 'h1');
$I->see('Все проекты', 'h2');

if (method_exists($I, 'wait')) {
    $I->wait(3);
}
