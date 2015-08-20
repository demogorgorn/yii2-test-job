<?php

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('All users');
$I->amOnPage('/users');

$I->see('Пользователи', 'h1');
$I->see('Все пользователи', 'h2');

if (method_exists($I, 'wait')) {
    $I->wait(3);
}
