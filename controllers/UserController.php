<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\User;


class UserController extends Controller
{
	
	
	public function actionSignout($redirect='/'){
		$user=User::getUser();
		if ($user)
			$user->signOut();
		$this->redirect([$redirect]);
	}
	
}