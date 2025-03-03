<?php

$db_params = require __DIR__ . '/db_param.php';

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=progetto_pancreas',
    'username' => $db_params['username'],
    'password' => $db_params['password'],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
