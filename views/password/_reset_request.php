<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app','Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="container">
        <div class="site-request-password-reset">
            <h1><?= Html::encode($this->title) ?></h1>

            <p><?=Yii::t('app','Please fill out your email. A link to reset password will be sent there.')?></p>

            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin([
                        'id' => 'request-password-reset-form',
                        'options'=>[
                            'class'=>'login-frm'
                        ],
                    ]); ?>

                        <?= $form->field($model, 'email') ?>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app','Send'), ['class' => 'btn btn--2 btn--2l btn--sm']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
