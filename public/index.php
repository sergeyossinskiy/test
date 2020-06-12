<?php

require __DIR__.'/../config.php';
require __DIR__.'/../vendor/autoload.php';

use App\Route;
use App\Database;

$dt = new Database();

Route::get("/","ProductsController@index");
