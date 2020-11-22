<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=divanru-postgres;port=5432;dbname=divanru',
    'username' => 'divanru',
    'password' => 'secret',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
