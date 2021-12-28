<?php

namespace Terpomoj\LaravelEncore\Tests;

use Terpomoj\LaravelEncore\EncoreServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [EncoreServiceProvider::class];
    }
}
