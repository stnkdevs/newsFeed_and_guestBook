<?php

use yii\widgets\LinkPager;

use yii\widgets\ActiveForm;

use yii\helpers\Html;

use yii\Helpers\Url;

use app\modules\newsfeed\models\News;

?>


<?php if (!$newslist):?>
Лента новостей пуста.
<?php else: foreach($newslist as $news): 
$news->title=Html::encode($news->title);
$news->content=Html::encode($news->content);
?>
<h1><?=Html::a($news->title, ['news/post', 'id'=>$news->id])?></h1>
<p><?=mb_substr($news->content, 0, 30)?><?=mb_strlen($news->content)>30?' ...':'';?></p>
<p>Опубликовано <?=$news->date?></p>

<hr>
<?php endforeach;?>
<?=LinkPager::widget(['pagination'=>$pagination]);?>
<?php endif;?>