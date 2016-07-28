<?php

namespace greeschenko\user\controllers;

use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;
use greeschenko\user\models\User;

/**
 * password controller for the `user` module
 */
class PasswordController extends Controller
{
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionResetRequest()
    {
        $model = new User();
        $model->scenario = 'reset';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendResetEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Check your email for further instructions.'));

                return $this->redirect('/user/login');
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Sorry, we are unable to reset password for email provided.'));
            }
        }

        return $this->render('_reset_request', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionReset($token)
    {
        $model = User::findByPasswordResetToken($token);
        if (!$model) {
            throw new InvalidParamException( Yii::t('app', 'Wrong password reset token.'));
        }

        $model->scenario = 'passchange';

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'New password was saved.'));

            return $this->redirect('/user/login');
        }

        return $this->render('reset', [
            'model' => $model,
        ]);
    }

    public function actionCheckStrong()
    {
        $res = [];
        $strong = 0;

        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            $password = Yii::$app->request->post()['password'];

            if (strlen($password) > 6) {
                $strong++;
            }
            if (strlen($password) > 10) {
                $strong++;
            }
            if (preg_match("/([0-9]+)/", $password)) {
                $strong++;
            }
            if (preg_match("/([a-z]+)/", $password)) {
                $strong++;
            }
            if (preg_match("/([A-Z]+)/", $password)) {
                $strong++;
            }
            if (preg_match("/\W/", $password)) {
                $strong++;
            }

            if ($strong == 1) {
                $res['msg'] = Yii::t('app', 'Very weak');
            }
            if ($strong == 4) {
                $res['msg'] = Yii::t('app', 'Weak');
            }
            if ($strong == 5) {
                $res['msg'] = Yii::t('app', 'Strong');
            }
            if ($strong == 6) {
                $res['msg'] = Yii::t('app', 'Very Strong');
            }

            $res['strong'] = $strong;
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $res;
    }
}
