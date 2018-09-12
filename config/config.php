<?php
$basePath=dirname(__DIR__);
$config = [

'id' => 'News',

'basePath'=>dirname(__DIR__),
    
'aliases' => [
		'@vendor'=>dirname(dirname(__DIR__)).'/vendor',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
		'@images'=>"$basePath/web/images",
    ],

'components'=> [
                'request' => [
					'cookieValidationKey' => 'dALdcuo3ohniiiUXcBW6ARMhy0Q017YO',
				],
				
				'db' =>	[
                        'class' => 'yii\db\Connection',
                        'dsn' => 'mysql:host=localhost;dbname=task',
                        'username' => 'root',
                        'password' => '1111',
                        'charset' => 'utf8',
                        ],

				'urlManager' => [
					'enablePrettyUrl' => true,
					'showScriptName' => false,
					'rules' => [],
					],
				],
				
];

return $config;