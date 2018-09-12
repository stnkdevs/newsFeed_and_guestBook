<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\News;
use yii\web\UploadedFile;
use app\models\User;


class NewsController extends Controller
{
	
	protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        return null;
    }
	
	public function actionAdd(){
		$news=new News();
		
		if ($news->load(Yii::$app->request->post()) && $news->validate()) {
			$news->imageUpload = UploadedFile::getInstance($news, 'imageUpload');
			$news->date=date('Y-m-d');
			$news->save(false);
        }		
        return $this->redirect(['news/manage']);
	}
	
	public function actionIndex(){
		$data=News::getList(5);
		return $this->render('index', $data);
	}
	
	private function checkAccess(){
		if (!User::isAuthorized() && Yii::$app->request->isPost) 
		{
			$user=new User();
			$user->load(Yii::$app->request->post());
			if (!$user->validate() || !$user->signIn())
				return $this->render('/user/login', ['user'=>$user]);
		}
		else if (!User::isAuthorized())
		{
			return $this->render('/user/login', ['user'=>new User()]);
		}
		$user=User::getUser();
		if (!$user->hasResponse('newsfeed-edit'))
				return $this->render('user/access_error');
		return false;
		
	}
	
	public function actionManage(){
		
		$filterResult=$this->checkAccess();
		if ($filterResult!==false)
			return $filterResult;
		
		$data=News::getList(5);
		return $this->render('manage', $data);
	}
	
	public function actionDelete($id){
		$filterResult=$this->checkAccess();
		if ($filterResult!==false)
			return $filterResult;
		
		$forRemoving=$this->findModel($id);
		if ($forRemoving)
			$forRemoving->delete();
		return $this->redirect(['news/manage']);
	}
	
	public function actionPost($id){
		$post=$this->findModel($id);
		return $this->render('post', ['post'=>$post]);
	}
	
}