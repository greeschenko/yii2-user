<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/password/reset', 'token' => $user->password_reset_token]);
?>

<?= Yii::t('app', 'Follow the link below to reset your password:')?>

<?= $resetLink ?>
