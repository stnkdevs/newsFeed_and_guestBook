<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);

require '../../vendor/autoload.php';
require '../../vendor/yiisoft/yii2/Yii.php';

$config = require '../config/config.php';

(new yii\web\Application($config))->run();
