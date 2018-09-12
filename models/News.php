<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;

use yii\helpers\ArrayHelper;

use yii\data\Pagination;

class News extends ActiveRecord
{
	public $imageUpload;
	
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
			[['imageUpload'], 'file', 'extensions'=>'png, jpg, jpeg', 'maxSize'=>1024*1000*5],
			[['image'], 'string', 'max'=>50],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'content' => 'Содержимое',
            'date' => 'Date',
            'imageUpload' => 'Изображение',
        ];
    }

	public static function getList($onpage=5){
		$query=News::find();
		$count=$query->count();
		$pagination=new Pagination(
			['totalCount'=>$count, 
			'pageSize'=>$onpage]);
		$news=$query->offset($pagination->offset)
		->limit($pagination->limit)
		->all();
		return ['newslist'=>$news, 'pagination'=>$pagination];
	}
	
	public function getImageSrc(){
		if ($this->image)
			return "/images/news/$this->image";
		else return NULL;
	}
	
	private function getImageFileName(){
		if ($this->image)
			return Yii::getAlias("@images/news/$this->image");
		else return NULL;
	}
	
	public function save($validate=true, $attrs=NULL) {
		if ($this->imageUpload){
			$baseName=uniqid();
			$extension=$this->imageUpload->extension;
			$fileName="$baseName.$extension";
			$path=Yii::getAlias("@images/news/$fileName");
			$this->imageUpload->saveAs($path);
			$this->image=$fileName;
		}
		else
		{
			var_dump($this);
			$this->image=NULL;
		}
		parent::save($validate, $attrs);
	}
	
	public function beforeDelete(){
		 if (!parent::beforeDelete()) {
			return false;
		}
		$fname=$this->getImageFileName();
		if ($fname && file_exists($fname))
			unlink($fname);
		return true;
	}

}
