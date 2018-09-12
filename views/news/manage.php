<?php

use yii\widgets\LinkPager;

use yii\widgets\ActiveForm;

use yii\helpers\Html;

use yii\Helpers\Url;

use app\models\News;

$news=new News();

$user=app\models\User::getUser();

?>

<!-- News adding form -->


<div class="news-form">

    <?php $form = ActiveForm::begin([
								'action'=>Url::to(['news/add'])
									]); ?>

    <?= $form->field($news, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($news, 'content')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($news, 'imageUpload')->fileInput() ?>

    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>

</div>


<!-- /News adding form -->

<?php if (!$newslist):?>
Лента новостей пуста.
<?php else: foreach($newslist as $news): 
$news->title=Html::encode($news->title);
$news->content=Html::encode($news->content);
?>
<h1><?=Html::a($news->title, ['news/post', 'id'=>$news->id])?></h1>
<p><?=mb_substr($news->content, 0, 30)?><?=mb_strlen($news->content)>30?' ...':'';?></p>
<p>Опубликовано <?=$news->date?></p>
<p><?=Html::a('Удалить новость', ['news/delete', 'id'=>$news->id])?></p>

<hr>
<?php endforeach;?>
<?=LinkPager::widget(['pagination'=>$pagination]);?>
<?php endif;?>

<p><?=Html::a("Выйти с учетной записи $user->login", ['user/signout', 'redirect'=>'news/manage'])?></p>