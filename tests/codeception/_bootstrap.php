<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require_once __DIR__ . '/../../../../autoload.php';
require_once __DIR__ . '/../../../../yiisoft/yii2/Yii.php';

Yii::setAlias('@tests', dirname(__DIR__));

\Codeception\Specify\Config::setDeepClone(false);
