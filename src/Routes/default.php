<?php

use Illuminate\Support\Facades\Route;
use Nette\Utils\Random;

Route::get('test', function () {
    $num = Random::generate();
    return <<<'blade'
        <h1>Hello from CoreLink</h1>
    blade;
});
