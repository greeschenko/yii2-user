<?php

namespace tests\codeception\unit\models;

use Yii;
use yii\codeception\TestCase;
use greeschenko\user\models\User;
use Codeception\Specify;

class ResetTest extends TestCase
{
    use Specify;

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        Yii::$app->user->logout();
        parent::tearDown();
    }

    //email not exist
    //mailexist demo@demo.d

    public function testResetWrongEmail()
    {
        $model = new User();

        $model->attributes = [
            'email' => 'not_valid_email@email.e',
        ];

        $model->scenario = 'reset';

        $this->specify('model has return error', function () use ($model) {
            expect('Check for error', $model->validate())->false();
        });
    }

    public function testResetPassEmail()
    {
        $model = new User();

        $model->attributes = [
            'email' => 'demo@demo.d',
        ];

        $model->scenario = 'reset';

        $this->specify('email should be send', function () use ($model) {
            expect('email is send', $model->sendResetEmail())->true();
        });
    }
}
