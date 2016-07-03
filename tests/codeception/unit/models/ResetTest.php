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
        Yii::$app->mailer->fileTransportCallback = function ($mailer, $message) {
            return 'testing_message.eml';
        };
    }

    protected function tearDown()
    {
        Yii::$app->user->logout();
        unlink($this->getMessageFile());
        parent::tearDown();
    }

    //email not exist
    //mailexist demo@demo.d

    /*public function testResetWrongEmail()
    {
        $model = new User();

        $model->attributes = [
            'email' => 'not_valid_email@email.e',
        ];

        $model->scenario = 'reset';

        $this->specify('model has return error', function () use ($model) {
            expect('Check for error', $model->validate())->false();
        });
    }*/

    public function testResetPassEmail()
    {
        $model = new User();

        $model->attributes = [
            'email' => 'demo@demo.d',
        ];

        $model->scenario = 'reset';

        $model->sendResetEmail();

        $this->specify('email should be send', function () {
            expect('email file should exist', file_exists($this->getMessageFile()))->true();
        });

        /*$this->specify('message should contain correct data', function () use ($model) {
            $emailMessage = file_get_contents($this->getMessageFile());

            expect('email should contain user name', $emailMessage)->contains($model->name);
            expect('email should contain sender email', $emailMessage)->contains($model->email);
        });*/
    }

    private function getMessageFile()
    {
        return Yii::getAlias(Yii::$app->mailer->fileTransportPath) . '/testing_message.eml';
    }
}
