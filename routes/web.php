<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo "Hello World";
});

require __DIR__ . '/auth.php';
