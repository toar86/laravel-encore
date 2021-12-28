<?php

use Illuminate\Support\Facades\Blade;
use Innocenzi\LaravelEncore\EncoreServiceProvider;

beforeEach(function () {
    $this->directives = Blade::getCustomDirectives();
});

it('creates directives', function () {
    expect($this->directives)
        ->toHaveKey(EncoreServiceProvider::SCRIPTS_BLADE_DIRECTIVE)
        ->toHaveKey(EncoreServiceProvider::STYLES_BLADE_DIRECTIVE);
});

it('parses script directive arguments', function () {
    expect($this->directives[EncoreServiceProvider::SCRIPTS_BLADE_DIRECTIVE]('"scripts", false'))
        ->toBe('<?php echo Innocenzi\LaravelEncore\Facade\Encore::getScriptTags(e("scripts"),e(false)); ?>');

    expect($this->directives[EncoreServiceProvider::SCRIPTS_BLADE_DIRECTIVE]('"scripts", true'))
        ->toBe('<?php echo Innocenzi\LaravelEncore\Facade\Encore::getScriptTags(e("scripts"),e(true)); ?>');

    expect($this->directives[EncoreServiceProvider::SCRIPTS_BLADE_DIRECTIVE](''))
        ->toBe('<?php echo Innocenzi\LaravelEncore\Facade\Encore::getScriptTags(e("app"),e(false)); ?>');
});

it('parses_link_directive_arguments', function () {
    expect($this->directives[EncoreServiceProvider::STYLES_BLADE_DIRECTIVE]('"link"'))
        ->toBe('<?php echo Innocenzi\LaravelEncore\Facade\Encore::getLinkTags(e("link")); ?>');

    expect($this->directives[EncoreServiceProvider::STYLES_BLADE_DIRECTIVE](''))
        ->toBe('<?php echo Innocenzi\LaravelEncore\Facade\Encore::getLinkTags(e("app")); ?>');
});
