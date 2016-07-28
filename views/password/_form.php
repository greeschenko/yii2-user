<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

\greeschenko\user\assets\UserAsset::register($this);
?>

<?php $form = ActiveForm::begin([
    'id' => 'passwordreset-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-md-3\">{input}</div>\n<div class=\"col-md-7\">{error}</div>",
        'labelOptions' => ['class' => 'col-md-2 control-label'],
    ],
]); ?>

    <?= $form->field($model, 'newpassword')->passwordInput() ?>
    <div class="row">
        <div id="strongmsg" class="strongpassmsg col-md-2"></div>
        <div class="strongpasswrap col-md-3">
            <div id="strongind" class=""></div>
        </div>
    </div>
    <?= $form->field($model, 'newpasswordre')->passwordInput() ?>

    <div class="form-group">
        <div class="col-md-offset-2 col-md-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>
