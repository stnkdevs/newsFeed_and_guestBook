<?php


use yii\helpers\Html;


?>



<?php if ($post):?>
<h1><?=$post->title?></h1>
<?php if ($post->getImageSrc()):?>
<?=Html::img($post->getImageSrc(), ['width'=>350])?>
<?php endif;?>
<p><?=$post->content?></p>
<p>Опубликовано <?=$post->date?></p>
<?php endif;?>