<?php

namespace greeschenko\user\components;

use Yii;
use yii\base\Component;
use greeschenko\user\models\User;

class Mail extends Component
{
    /** @var string */
    public $viewPath = '@greeschenko/user/mail';

    public $sender;

    private $module;

    public function init()
    {
        $this->module = Yii::$app->getModule('user');
        parent::init();
    }

    public function sendResetToken(User $user)
    {
        return $this->send(
            $to = $user->email,
            $subj = Yii::t('app', 'Welcome to {0}', Yii::$app->name),
            $viewname = 'passwordResetToken',
            $params = [ 'user' => $user ]
        );
    }

    protected function send($to,$subj,$viewname,$params = [])
    {
        $mailer = Yii::$app->mailer;
        $mailer->viewPath = $this->viewPath;

        if ($this->sender === null) {
            $this->sender = ($this->module->params['adminEmail'])
                ? $this->module->params['adminEmail']
                : (Yii::$app->params['adminEmail'])
                    ? Yii::$app->params['adminEmail']
                    : 'no-reply@example.com';
        }

        return $mailer->compose(['html' => $viewname.'-html', 'text' => $viewname.'-text'], $params)
                ->setFrom([ $this->sender => \Yii::$app->name . ' support'])
                ->setTo($to)
                ->setSubject($subj)
                ->send();
    }
}
