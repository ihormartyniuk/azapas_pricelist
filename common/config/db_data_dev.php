<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=autozapas.com;port=5556;dbname=data_dev',
    'username' => 'data_dev',
    'password' => 'wf5437ther',
    'charset' => 'utf8',
    'attributes' => [
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false
    ],
    'enableSchemaCache' => true
];
