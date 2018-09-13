<?php


namespace app\models;

class Captcha extends \yii\base\Model
{
	private $text=null;
	private $isCorrect=null;
	private $id;
	private static $fontPath='';
	public $inputCode='';
	
	
	public function rules() {
		return [
			['inputCode', function($attr, $params){
				if(!$this->check($this->$attr))
					$this->addError($attr, 'Введенный код не совпадает с кодом на картинке.');
			}, 'skipOnEmpty' => false],
		];
	}
	
	public function attributeLabels(){
		return ['inputCode'=>'Код с картинки'];
	}
	
	public function getContentType() {
		return 'image/png';
	}
	
	private static $instances=[];
	
	public function __construct($id) {
		$this->id=$id;
		if (isset(\Yii::$app->session["captcha.$id"]))
			$this->text=\Yii::$app->session["captcha.$id"];
	}
	
	private function refresh(){
		$this->text=self::randomText();
		\Yii::$app->session["captcha.$this->id"]=$this->text;
	}
	
	public static function getInstance($id){
		if (isset(self::$instances[$id]))
			return $instances[$id];
		else
		{
			return self::$instances[$id]=new Captcha($id);
		}
	}
	
	public static function randomText(){
		$string = '';
		for ($i = 0; $i < 5; $i++)
			$string .= chr(rand(97, 122));
		return $string;
	}
	
	public function generateImage(){
		$this->refresh();
		$image = imagecreatetruecolor(170, 60);
		$black = imagecolorallocate($image, 0, 0, 0);
		$white = imagecolorallocate($image, 255, 255, 255);
		imagefilledrectangle($image,0,0,399,99,$white);
		imagettftext ($image, 30, 0, 10, 40, $black, \Yii::getAlias("@app/fonts/verdana.ttf"), $this->text);
		imagepng($image);
		imagedestroy($image);
	}
	
	public function check($code){
		if (is_null($this->isCorrect)) {
			$this->isCorrect=($this->text==$code);
			unset(\Yii::$app->session["captcha.$this->text"]);
		}
		return $this->isCorrect;
	}
	
	
}