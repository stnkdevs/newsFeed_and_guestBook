<?php 

use yii\helpers\Html;

use app\models\User;

?>
Ошибка доступа!<br>
У Вас недостаточно привелегий для выполнения действий на этой странице.<br>
Попробуйте уточнить детали в администратора, и когда доступ будет открыт<br>
выйдите из системы и войдите снова.
<?php $user=User::getUser(); if ($user):?>
<p><?=Html::a("Выйти с учетной записи $user->login", ['/user/signout', 'redirect'=>'/newsfeed/news/manage'])?></p>
<?php endif;?>