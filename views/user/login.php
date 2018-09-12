<?php

use yii\widgets\ActiveForm;

use yii\helpers\Html;

?>

<?php $form=ActiveForm::begin(); ?>
<?= $form->field($user, 'login')->textInput(['maxlength' => true]) ?>
<?= $form->field($user, 'password')->passwordInput(['maxlength' => true]) ?>

<?php $other_errors=$user->getErrors('');?>
<?php if ($other_errors):?>
<ul>
<?php foreach($other_errors as $err):?>
<li><?=$err?></li>
<?php endforeach;?>
</ul>
<?php endif;?>

<?= Html::submitButton('Вход', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>