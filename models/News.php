<?php

namespace app\models;

use Yii;

use \yii\db\ActiveRecord;

use yii\helpers\ArrayHelper;

use yii\data\Pagination;

class News extends ActiveRecord
{
	public static function tableName()
    {
        return 'news';
    }

    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['title','content'], 'string'],
            [['title'], 'string', 'max' => 255],
			[['content'], 'string', 'max'=>750],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'content' => 'Содержимое',
            'date' => 'Date',
            'image' => 'Image',
        ];
    }

	public static function getList($onpage=5){
		$query=News::find();
		$count=$query->count();//require time to count all records - bad. TODO
		$pagination=new Pagination(
			['totalCount'=>$count, 
			'pageSize'=>$onpage]);
		$news=$query->offset($pagination->offset)
		->limit($pagination->limit)
		->all();
		return ['newslist'=>$news, 'pagination'=>$pagination];
	}
	
	public function getImageSrc(){
		return '/images/news/default.png';
	}
	

}
