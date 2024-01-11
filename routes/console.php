<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})
    ->purpose('Display an inspiring quote');

Artisan::command('db:recreate', function () {
    $this->call('migrate:fresh');
    $this->call('db:seed');
})
    ->purpose('Recreates the database tables (drops all before) and fill them with data.');

Artisan::command('build:production:new', function () {
    $this->call('db:recreate');
    $this->call('storage:link');
    $this->call('key:generate');
    $this->call('config:cache');
    $this->call('route:cache');
    $this->call('view:cache');
})
    ->purpose('Builds the production environment FROM NEW');

Artisan::command('build:production', function () {
    $this->call('migrate');
    $this->call('storage:link');
    $this->call('config:cache');
    $this->call('route:cache');
    $this->call('view:cache');
})
    ->purpose('Builds the production environment');

Artisan::command('build:dev', function () {
    $this->call('db:recreate');
    $this->call('storage:link');
    $this->call('key:generate');
})
    ->purpose('Builds the development environment FROM NEW');
