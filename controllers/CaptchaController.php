<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Captcha;


class CaptchaController extends Controller
{
	public function actionIndex($id){
		$captcha=Captcha::getInstance($id);
		$headers=\Yii::$app->response->getHeaders()->set('Content-Type', 'image/png');
		\Yii::$app->response->format=\yii\web\Response::FORMAT_RAW;
		$captcha->generateImage();
	}	
}