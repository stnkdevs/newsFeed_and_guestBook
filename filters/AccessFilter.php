<?php

namespace app\filters;

use Yii;
use yii\base\ActionFilter;
use app\models\User;

class AccessFilter extends ActionFilter
{
	public $responsibility='';
	
    private function failed($responseContent) {
		Yii::$app->response->content=$responseContent;
		return false;
	}

    public function beforeAction($action)
    {
		$controller=$action->controller;
		if (!User::isAuthorized() && Yii::$app->request->isPost) 
		{
			$user=new User();
			$user->load(Yii::$app->request->post());
			if (!$user->validate() || !$user->signIn()){
				$user->password='';
				return $this->failed($controller->render('//user/login', ['user'=>$user]));
			}
		}
		else if (!User::isAuthorized())
		{
			return $this->failed($controller->render('//user/login', ['user'=>new User()]));
		}
		$user=User::getUser();
		if (!$user->hasResponsibility($this->responsibility))
				return $this->failed($controller->render('//user/access_error'));
			
		return true;//OK
    }
}