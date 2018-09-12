<?php



namespace app\models;

class User extends \yii\db\ActiveRecord
{
	
	public function rules(){
		$regexValidator=
		function($attr, $params){
			if (!preg_match($params['regex'], $this->$attr))
				$this->addError($attr, $params['msg']);
			
		};
		return [
			[['login'], $regexValidator, 'params'=>['regex'=>'%^[0-9a-z_-]{3,50}$%i', 'msg'=>'Разрешены латиница, цифры, символ подчеркивания и дефис. Длина от 3 до 50 символов']],
			[['password'], $regexValidator, 'params'=>['regex'=>'%^[0-9a-z_-]{6,50}$%i', 'msg'=>'Разрешены латиница, цифры, символ подчеркивания и дефис. Длина пароля от 6 до 50 символов']],
		];
	}
	
	public static function tableName()
    {
        return 'user';
    }
	
	public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль'
        ];
    }
	
	public function signIn(){
		if(!$this->validate())
			return false;
		$user=User::findOne(['login'=>$this->login]);
		if (!$user || $this->password!=$user->password){
			$this->addError('', 'Неверная пара логин/пароль.');//TODO 22:40
			return false;
		}
		else
		{
			\Yii::$app->session['current_user']=$user;
			return true;
		}
	}
	
	public function signOut(){
		unset(\Yii::$app->session['current_user']);
	}
	
	public static function isAuthorized(){
		return isset(\Yii::$app->session['current_user']);
	}
	public static function getUser(){
		if (static::isAuthorized())
			return \Yii::$app->session['current_user'];
		else return NULL;
	}
	
	public function hasResponse($response){
		$responses=explode(';',$this->responses);
		return in_array($response, $responses);
	}
	
}