<?php

namespace app\modules\gbook\models;

use Yii;

use yii\db\ActiveRecord;

use yii\helpers\ArrayHelper;

use yii\data\Pagination;

class Post extends ActiveRecord
{
	public static function tableName()
    {
        return 'gpost';
    }

    public function rules()
    {
        return [
            [['name', 'text', 'email'], 'required'],
            [['email'], 'email'],
			[['email'], 'string', 'max' => 40],
            [['text'], 'string', 'max' => 750],
			[['name'], 'string', 'max'=>30],
			[['name'], 'app\validators\RegexValidator', 'regex'=>'%^[0-9a-z]{3,30}$%i', 'msg'=>'Разрешены латиница и цифры. Длина от 3 до 30 символов'],
        ];
    }
	
    public function attributeLabels()
    {
        return [
            'email' => 'Адрес e-mail',
            'name' => 'Имя',
            'text' => 'Сообщение',
        ];
    }

	public static function getList($onpage=5){
		$query=Post::find();
		$count=$query->count();
		$pagination=new Pagination(
			['totalCount'=>$count, 
			'pageSize'=>$onpage]);
		$posts=$query->offset($pagination->offset)
		->orderBy(['id'=>SORT_DESC])
		->limit($pagination->limit)
		->all();
		return ['posts'=>$posts, 'pagination'=>$pagination];
	}
}
