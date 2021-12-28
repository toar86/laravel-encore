<?php

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\HtmlString;
use Terpomoj\LaravelEncore\Facade\Encore;
use Terpomoj\LaravelEncore\Tests\TestCase;

it('generates script tags from entrypoints', function () {
    Config::set('encore.output_path', 'build');
    Config::set('encore.files.entrypoints', 'entrypoints.json');

    Encore::shouldReceive('readJsonFile')
        ->once()
        ->with(\config('encore.files.entrypoints'))
        ->andReturn([
            'entrypoints' => [
                'app' => [
                    'js' => [
                        '/' . config('encore.output_path') . '/app.js',
                        '/' . config('encore.output_path') . '/test.js',
                    ],
                ],
            ],
        ]);
    Encore::makePartial();

    expect(Encore::getScriptTags('app')?->toHtml())
        ->toBe('<script src="/build/app.js" defer></script><script src="/build/test.js" defer></script>');
});

it('generates link tags from entrypoints', function () {
    Config::set('encore.output_path', 'build');
    Config::set('encore.files.entrypoints', 'entrypoints.json');

    Encore::shouldReceive('readJsonFile')
        ->once()
        ->with(\config('encore.files.entrypoints'))
        ->andReturn([
            'entrypoints' => [
                'app' => [
                    'css' => [
                        '/' . config('encore.output_path') . '/app.css',
                        '/' . config('encore.output_path') . '/admin.css',
                    ],
                ],
            ],
        ]);
    Encore::makePartial();

    expect(Encore::getLinkTags('app')?->toHtml())
        ->toBe('<link rel="stylesheet" href="/build/app.css"/><link rel="stylesheet" href="/build/admin.css"/>');
});

it('returns assets from manifest', function () {
    Config::set('encore.output_path', 'build');
    Config::set('encore.files.manifest', 'manifest.json');

    Encore::shouldReceive('readJsonFile')
        ->times(3)
        ->with(\config('encore.files.manifest'))
        ->andReturn([
            'build/0.17df4183.js' => '/build/0.17df4183.js',
            'build/app.js' => '/build/app.d158d12f.js',
            'build/runtime.js' => '/build/runtime.420770e4.js',
            'build/image.png' => '/build/image.z456g32z.png',
        ]);
    Encore::makePartial();

    expect(Encore::asset('build/app.js'))
        ->toBe('/build/app.d158d12f.js');

    expect(Encore::asset('build/runtime.js'))
        ->toBe('/build/runtime.420770e4.js');

    expect(Encore::asset('build/image.png'))
        ->toBe('/build/image.z456g32z.png');
});
