<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Password Reset');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="user-resetpassword">
    <h1><?= Html::encode($this->title) ?></h1>

    <?=$this->render('_form',[ 'model' => $model ])?>
</div>
