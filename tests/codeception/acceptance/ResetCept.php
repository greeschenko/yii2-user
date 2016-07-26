<?php

use tests\codeception\_pages\LoginPage;
use greeschenko\user\models\User;

/* @var $scenario Codeception\Scenario */

// go to login page
// click Password reset btn
// set wrongemail in field
// set right email in field
// go to reset url change Password
// go login page and login

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that login works');

$loginPage = LoginPage::openBy($I);

if (method_exists($I, 'wait')) {
    $I->wait(1);
}

$I->see('Login', 'h1');

$I->amGoingTo('go to password reset');
$I->click('I forget my password');

if (method_exists($I, 'wait')) {
    $I->wait(1);
}

$I->expectTo('see error on blank');
$I->fillField('input[name="User[email]"]', '');
$I->click('Send');

if (method_exists($I, 'wait')) {
    $I->wait(1);
}

$I->see('Email cannot be blank.');

$I->expectTo('see error on wrong email');
$I->fillField('input[name="User[email]"]', 'wrong@email.com');
$I->click('Send');

if (method_exists($I, 'wait')) {
    $I->wait(1);
}

$I->see('There is no user with such email.');

$I->expectTo('see success message');
$I->fillField('input[name="User[email]"]', 'demo@demo.d');
$I->click('Send');

if (method_exists($I, 'wait')) {
    $I->wait(1);
}

$I->see('Check your email for further instructions.');

if (method_exists($I, 'wait')) {
    $I->wait(1);
}

$user = User::findOne(['email' => 'demo@demo.d']);

$I->amOnPage('/user/password/reset?token='.$user->password_reset_token);

$I->fillField('input[name="User[newpassword]"]', '');
$I->fillField('input[name="User[newpasswordre]"]', '');
$I->click('Save');
if (method_exists($I, 'wait')) {
    $I->wait(1);
}
$I->see('New Password cannot be blank.');
$I->see('New Password Repiat cannot be blank.');

$I->fillField('input[name="User[newpassword]"]', '111111');
$I->fillField('input[name="User[newpasswordre]"]', '222222');
$I->click('Save');
if (method_exists($I, 'wait')) {
    $I->wait(1);
}
$I->see('New Password Repiat must be equal to "New Password".');

$I->fillField('input[name="User[newpassword]"]', 'demopass');
$I->fillField('input[name="User[newpasswordre]"]', 'demopass');
$I->click('Save');
if (method_exists($I, 'wait')) {
    $I->wait(2);
}
$I->see('New password was saved.');
