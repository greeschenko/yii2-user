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
}
