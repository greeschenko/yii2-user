<?php

namespace tests\codeception\unit\models;

use Yii;
use yii\codeception\TestCase;
use greeschenko\user\models\User;
use Codeception\Specify;

class LoginFormTest extends TestCase
{
    use Specify;

    protected function tearDown()
    {
        Yii::$app->user->logout();
        parent::tearDown();
    }

    public function testLoginNoUser()
    {
        $model = new User([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        $model->scenario = 'login';

        $this->specify('user should not be able to login, when there is no identity', function () use ($model) {
            expect('model should not login user', $model->login())->false();
            expect('user should not be logged in', Yii::$app->user->isGuest)->true();
        });
    }

    public function testLoginWrongPassword()
    {
        $model = new User([
            'username' => 'demo@demo.d',
            'password' => 'wrong_password',
        ]);
        $model->scenario = 'login';

        $this->specify('user should not be able to login with wrong password', function () use ($model) {
            expect('model should not login user', $model->login())->false();
            expect('error message should be set', $model->errors)->hasKey('password');
            expect('user should not be logged in', Yii::$app->user->isGuest)->true();
        });
    }

    public function testLoginCorrect()
    {
        $model = new User([
            'username' => 'demo@demo.d',
            'password' => 'demopass',
        ]);
        $model->scenario = 'login';

        $this->specify('user should be able to login with correct credentials', function () use ($model) {
            expect('model should login user', $model->login())->true();
            expect('error message should not be set', $model->errors)->hasntKey('password');
            expect('user should be logged in', Yii::$app->user->isGuest)->false();
        });
    }
}
