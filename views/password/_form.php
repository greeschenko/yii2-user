<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin([
    'id' => 'passwordreset-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
]); ?>

    <?= $form->field($model, 'newpassword')->passwordInput() ?>
    <?= $form->field($model, 'newpasswordre')->passwordInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>
