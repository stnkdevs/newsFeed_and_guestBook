<?php

namespace app\modules\newsfeed\controllers;

use Yii;
use yii\web\Controller;
use app\modules\newsfeed\models\News;
use yii\web\UploadedFile;
use app\models\User;


class NewsController extends Controller
{
	public function behaviors()
	{
		return [
			[
				'class' => 'app\filters\AccessFilter',
				'only' => ['manage', 'delete'],
				'responsibility'=>'newsfeed-edit',
			],
		];
	}
	
	protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        return null;
    }
	
	public function actionAdd(){
		$news=new News();
		if (Yii::$app->request->isPost) {
			$news->load(Yii::$app->request->post());
			if ($news->validate()) {
				$news->imageUpload = UploadedFile::getInstance($news, 'imageUpload');
				$news->date=date('Y-m-d');
				$news->save(false);
			}
		}		
        return $this->redirect(['news/manage']);
	}
	
	public function actionIndex(){
		$data=News::getList(5);
		return $this->render('index', $data);
	}
	
	public function actionManage(){	
		$data=News::getList(5);
		return $this->render('manage', $data);
	}
	
	public function actionDelete($id){
		$forRemoving=$this->findModel($id);
		if ($forRemoving)
			$forRemoving->delete();
		$headers=Yii::$app->request->headers;
		$redirect=$headers->has('Referer')?$headers->get('Referer'):['news/manage'];
		return $this->redirect($redirect);
	}
	
	public function actionPost($id){
		$post=$this->findModel($id);
		return $this->render('post', ['post'=>$post]);
	}
	
}