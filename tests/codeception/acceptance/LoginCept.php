<?php

use tests\codeception\_pages\LoginPage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that login works');

$loginPage = LoginPage::openBy($I);

if (method_exists($I, 'wait')) {
    $I->wait(5);
}

$I->see('Login', 'h1');

$I->amGoingTo('try to login with empty credentials');
$loginPage->login('', '');
if (method_exists($I, 'wait')) {
    $I->wait(1);
}
$I->expectTo('see validations errors');
$I->see('Email cannot be blank.');
$I->see('Password cannot be blank.');

if (method_exists($I, 'wait')) {
    $I->wait(2);
}

$I->amGoingTo('try to login with wrong credentials');
$loginPage->login('admin', 'wrong');
if (method_exists($I, 'wait')) {
    $I->wait(1);
}
$I->expectTo('see validations errors');
$I->see('Incorrect email or password');

$I->amGoingTo('try to login with correct credentials');
$loginPage->login('demo@demo.d', 'demopass');
if (method_exists($I, 'wait')) {
    $I->wait(1);
}
$I->expectTo('see user info');
$I->dontSee('Incorrect email or password');
if (method_exists($I, 'wait')) {
    $I->wait(1);
}
