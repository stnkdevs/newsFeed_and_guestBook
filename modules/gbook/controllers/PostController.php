<?php

namespace app\modules\gbook\controllers;

use Yii;
use yii\web\Controller;
use app\modules\gbook\models\Post;
use app\models\User;
use app\models\Captcha;


class PostController extends Controller
{
	public function behaviors()
	{
		return [
			[
				'class' => 'app\filters\AccessFilter',
				'only' => ['manage', 'delete', 'edit'],
				'responsibility'=>'guestbook-edit',
			],
		];
	}
	
	protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }
        return null;
    }
	
	public function add($post){

		if ($post->validate()) {
			$post->date=date('Y-m-d');
			return $post->save(false);
        }
		return false;
	}
	
	public function actionIndex(){
		$post=new Post();
		$captcha=Captcha::getInstance('');
		if (Yii::$app->request->isPost){
			$post->load(Yii::$app->request->post());
			$captcha->load(Yii::$app->request->post());
			if($captcha->validate() && $this->add($post)) {
				$headers=Yii::$app->request->headers;
				$redirect=$headers->has('Referer')?$headers->get('Referer'):['index'];
				return $this->redirect($redirect);
			}
		}
		$data=Post::getList(5);
		$data['post']=$post;
		$data['captcha']=$captcha;
		$data['saveLabel']='Оставить отзыв';
		return $this->render('index', $data);
	}
	
	
	public function actionManage() {
		$data=Post::getList(5);
		return $this->render('manage', $data);
	}
	
	public function actionDelete($id){		
		$forRemoving=$this->findModel($id);
		if ($forRemoving)
			$forRemoving->delete();
		$headers=Yii::$app->request->headers;
		$redirect=$headers->has('Referer')?$headers->get('Referer'):['manage'];
		return $this->redirect($redirect);
	}
	
	public function actionEdit($id){
		$post=$this->findModel($id);
		if (!$post)
		{
			return $this->redirect(['manage']);
		}
		$data=['saveLabel'=>'Сохранить', 'post'=>$post];
		if (Yii::$app->request->isPost) {
			$post->load(Yii::$app->request->post());
			if (!$post->validate() || !$post->save(false))
				return  $this->render('postform', $data);
			else {
				return $this->redirect(['manage']);
			}
		}
		else {
			return $this->render('postform', $data);
		}			
	}
}