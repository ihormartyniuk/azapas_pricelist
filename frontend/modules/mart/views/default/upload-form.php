<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = new ActiveForm();

$form->begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'title')->textInput() ?>

<?= $form->field($model, 'pricelist')->fileInput() ?>

<?= Html::submitButton('Upload', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
<?php
$form->end();
?>
