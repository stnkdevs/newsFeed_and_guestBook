<?php

use yii\widgets\LinkPager;

use yii\widgets\ActiveForm;

use yii\helpers\Html;

use app\models\News;

$news=new News();

?>

<!-- News adding form -->

<div class="news-form">

    <?php $form = ActiveForm::begin(['action'=>'news/add']); ?>

    <?= $form->field($news, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($news, 'content')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($news, 'image')->fileInput() ?>

    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>

</div>

<!-- /News adding form -->

<?php if (!$newslist):?>
Лента новостей пуста.
<?php else: foreach($newslist as $news): ?>
<h1><?=$news->title?></h1>
<p><?=mb_substr($news->content, 0, 30)?><?=mb_strlen($news->content)>30?' ...':'';?></p>
<p>Опубликовано <?=$news->date?></p>
<hr>
<?php endforeach;?>
<?=LinkPager::widget(['pagination'=>$pagination]);?>
<?php endif;?>