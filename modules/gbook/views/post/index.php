<?php

use yii\widgets\LinkPager;

use yii\helpers\Html;

use app\modules\newsfeed\models\News;


?>

<div class="row">
<div class="col-md-1"></div>
<div class="col-md-8">
<h2>Отзывы пользователей:</h2><br>
<?php if (!$posts):?>
Пока отзывов нет. Станьте первым кто оставит отзыв!
<?php else: foreach($posts as $_post):?>
<p><?=Html::encode($_post->text)?></p>
<p>Опубликовано пользователем <?=$_post->name?><br><?=$_post->date?></p>

<hr>
<?php endforeach;?>
<?=LinkPager::widget(['pagination'=>$pagination]);?>
<?php endif;?>
</div>
</div>

<div class="row">
<div class="col-md-1"></div>
<div class="col-md-4">
<h2>Хотите оставить свой отзыв?</h2>
<?=$this->render('postform', ['post'=>$post, 'captcha'=>&$captcha, 'saveLabel'=>&$saveLabel]);?>
</div>
</div>