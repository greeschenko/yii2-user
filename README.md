yii2constructive user module
============================
Highly variable user registration, authentication and management system

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist greeschenko/yii2-user "*"
```

or add

```
"greeschenko/yii2-user": "*"
```

to the require section of your `composer.json` file.


update database

$ php yii migrate/up --migrationPath=@vendor/greeschenko/yii2-user/migrations


Usage
-----

add to you app config

```
'modules'=>[
    'user'=> [
        'class'=>'greeschenko\user\Module',
    ],
],
```
and change identityClass

```
    'components' => [
        ...
        'user' => [
            'identityClass' => 'greeschenko\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/login'],
        ],
        ...
    ]

```

and uncomment urlManager component

```
    'components' => [
        ...
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        ...
    ]
```
