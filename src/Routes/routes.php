<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Nette\Utils\Random;
use Symfony\Component\Console\Output\ConsoleOutput;

Route::post('/corelink/register', function (Request $request) {
    $output = new ConsoleOutput();
    $output->write($request);
})->middleware(\Singlephon\Corelink\Middleware\ChildServiceAuth::class);
