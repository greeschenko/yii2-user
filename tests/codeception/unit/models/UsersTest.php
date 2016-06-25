<?php

namespace tests\codeception\unit\models;

use yii\codeception\TestCase;
use Codeception\Specify;
use greeschenko\user\models\User;
use tests\codeception\unit\fixtures\UserFixture;

class UsersTest extends TestCase
{
    use Specify;

    public function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    public function testUsersList()
    {
        $models = User::find()->all();

        $this->specify('check user list', function () use ($models) {
            expect('models count > 0', (count($models) > 0))->true();
        });
    }

    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'users' => [ 'class' => UserFixture::className(),
                'dataFile' => '@tests/codeception/unit/fixtures/data/users.php'
            ],
        ];
    }
}
