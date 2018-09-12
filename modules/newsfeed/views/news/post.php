<?php


use yii\helpers\Html;


?>



<?php if ($post):?>
<h1><?=$post->title?></h1>
<?php if ($post->getImageSrc()):?>
<img src="<?=$post->getImageSrc()?>"/>
<?php endif;?>
<p><?=$post->content?></p>
<p>Опубликовано <?=$post->date?></p>
<?php endif;?>