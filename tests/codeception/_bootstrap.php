<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

defined('YII_TEST_ENTRY_URL') or define('YII_TEST_ENTRY_URL', parse_url(\Codeception\Configuration::config()['config']['test_entry_url'], PHP_URL_PATH));
defined('YII_TEST_ENTRY_FILE') or define('YII_TEST_ENTRY_FILE', __DIR__ . '/../../../../web/index-test.php');

require_once __DIR__ . '/../../../../autoload.php';
require_once __DIR__ . '/../../../../yiisoft/yii2/Yii.php';

$_SERVER['SCRIPT_FILENAME'] = YII_TEST_ENTRY_FILE;
$_SERVER['SCRIPT_NAME'] = YII_TEST_ENTRY_URL;

Yii::setAlias('@tests', dirname(__DIR__));

\Codeception\Specify\Config::setDeepClone(false);
