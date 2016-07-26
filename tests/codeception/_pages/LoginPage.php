<?php

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents login page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class LoginPage extends BasePage
{
    public $route = 'user/login/index';

    /**
     * @param string $username
     * @param string $password
     */
    public function login($email, $password)
    {
        $this->actor->fillField('input[name="User[email]"]', $email);
        $this->actor->fillField('input[name="User[password]"]', $password);
        $this->actor->click('login-button');
    }
}
