<?php
namespace Tests;
use Illuminate\Support\Facades\Artisan;

trait MigrateFreshSeedOnce
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');

    }
}
