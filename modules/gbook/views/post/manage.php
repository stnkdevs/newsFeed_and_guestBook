<?php

use yii\widgets\LinkPager;

use yii\helpers\Html;

use app\modules\newsfeed\models\News;

$user=app\models\User::getUser();

?>

<?php if (!$posts):?>
Пока отзывов нет. Станьте первым кто оставит отзыв!
<?php else: foreach($posts as $post): 
$post->text=Html::encode($post->text);
?>
<p><?=$post->text?></p>
<p>Опубликовано пользователем <?=$post->name?><br><?=$post->date?></p>
<p><?=Html::a('Удалить сообщение', ['delete', 'id'=>$post->id])?></p>
<p><?=Html::a('Редактировать', ['edit', 'id'=>$post->id])?></p>
<hr>
<?php endforeach;?>
<?=LinkPager::widget(['pagination'=>$pagination]);?>
<?php endif;?>

<p><?=Html::a("Выйти с учетной записи $user->login", ['/user/signout', 'redirect'=>'/gbook/post/manage'])?></p>