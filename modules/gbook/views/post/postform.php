<?php

use yii\widgets\ActiveForm;

use yii\Helpers\Url;

use yii\helpers\Html;

if(!isset($saveLabel))
	$saveLabel='Сохранить';

?>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($post, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($post, 'email')->textInput() ?>
	
	<?= $form->field($post, 'text')->textarea(['rows' => 6]) ?>
		
	<?php if(isset($captcha)): ?>

	<?= Html::img(Url::to(['//captcha/index', 'id'=>'']))?>
	
	<?= $form->field($captcha, 'inputCode')->textInput()?>
	
	<?php endif;?>

    <?= Html::submitButton($saveLabel, ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>
