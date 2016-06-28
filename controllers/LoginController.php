<?php

namespace greeschenko\user\controllers;

use Yii;
use yii\web\Controller;
use greeschenko\user\models\User;

/**
 * Default controller for the `user` module
 */
class LoginController extends Controller
{
    /**
     * Login action.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new User(['scenario'=>'login']);
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
