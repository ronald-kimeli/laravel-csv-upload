<?php

namespace App\Http\Traits;

use Doctrine\DBAL\DriverManager;
use Illuminate\Support\Facades\DB;

trait Synchronize {
    function synchronizeDatabases($api_key,$id) {
    // //..
        $connectionParams = [
            'app1' => [
            'dbname' => env('APP1_DB_DATABASE'),
            'user' => env('APP1_DB_USERNAME'),
            'password' => env('APP1_DB_PASSWORD'),
            'host' => env('APP1_DB_HOST'),
            'driver' => 'pdo_mysql',
            ],
            'app2' => [
            'dbname' => env('APP2_DB_DATABASE'),
            'user' => env('APP2_DB_USERNAME'),
            'password' => env('APP2_DB_PASSWORD'),
            'host' => env('APP2_DB_HOST'),
            'driver' => 'pdo_mysql',
            ]
        ];

            foreach ($connectionParams as $connectionNameparams) {
                $conn = DriverManager::getConnection($connectionNameparams);
                $conn->executeQuery("UPDATE users SET api_key = '{$api_key}' where id='{$id}'");
            }
    }
}
