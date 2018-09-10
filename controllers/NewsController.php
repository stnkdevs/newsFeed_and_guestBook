<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\News;


class NewsController extends Controller{
	
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
			$news->date=date('Y-m-d');
			$news->save();
        }		
        return $this->redirect('news/index');
	}
	
	public function actionIndex(){
		$data=News::getList(5);
		return $this->render('news/index', $data);
	}
	
	public function actionDelete($id){
		$this->findModel($id)->delete();
		return $this->redirect('news/index');
	}
	
	public function actionPost($id){
		$post=$this->findModel($id);
		return $this->render('post', ['post'=>$post]);
	}
	
}