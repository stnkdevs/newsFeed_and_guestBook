<?php


use yii\helpers\Html;


?>



<?php if ($post):?>
<h1><?=$post->title?></h1>
<img src="<?=$post->getImageSrc()?>"/>
<p><?=$post->content?></p>
<p>Опубликовано <?=$post->date?></p>
<?php endif;?>