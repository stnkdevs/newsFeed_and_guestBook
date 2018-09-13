<?php

namespace app\validators;

use yii\validators\Validator;

class RegexValidator extends Validator
{
	public $regex, $msg;
	
    public function validateAttribute($model, $attribute)
    {
		if (!preg_match($this->regex, $model->$attribute)) {
				$this->addError($model, $attribute, $this->msg);
		}
    }
}