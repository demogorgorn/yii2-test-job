<?php

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('Все проекты');
$I->amOnPage('/projects');
$I->see('Все проекты', 'h1');
$I->see('Последние проекты', 'h2');

if (method_exists($I, 'wait')) {
    $I->wait(3);
}
