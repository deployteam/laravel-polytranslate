## Laravel PolyTranslate

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-actions]][link-actions]

### Install
Require this package with composer using the following command:

```bash
composer require deployteam/laravel-polytranslate
```

After updating composer, add the service provider to the `providers` array in `config/app.php`

```php
DeployTeam\PolyTranslate\ServiceProvider::class,
```

If you want to use the facade, add this to your facades in app.php:

```php
'PolyTranslate' => DeployTeam\PolyTranslate\Facade::class,
```

**>= Laravel 5.5** uses Package Auto-Discovery, so it's not required to manually add the ServiceProvider and the Facade.

### Usage

Using PolyTranslate you can add multiple paths for language loading:

```php
PolyTranslate::addPath(['themes/base/lang', 'themes/child/lang']); // without namespace
PolyTranslate::addNamespace('theme', ['themes/base/lang', 'themes/child/lang']); // with namespace
```

Laravel will start searching the directories for languages, and will merge anything it finds.

```php
// themes/base/lang/en/header.php
return [
    'greetings' => 'Hello',
    'login' => 'Login'
];
```

```php
// themes/child/lang/en/header.php
return [
    'login' => 'Authenticate',
    'register' => 'Register'
];
```

The final result will be:
```php
[
    'greetings' => 'Hello',
    'login' => 'Authenticate',
    'register' => 'Register'
]
```

To use the translation, you just use the built-in Laravel functionality:

```html
@lang('header.greetings') <!-- Without namespace -->
@lang('theme::header.greetings') <!-- With namespaces -->
```

### License

The Laravel PolyTranslate is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

[ico-version]: https://img.shields.io/packagist/v/deployteam/laravel-polytranslate.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/deployteam/laravel-polytranslate.svg?style=flat-square
[ico-actions]: https://github.com/deployteam/laravel-polytranslate/workflows/Build/badge.svg

[link-packagist]: https://packagist.org/packages/deployteam/laravel-polytranslate
[link-downloads]: https://packagist.org/packages/deployteam/laravel-polytranslate
[link-actions]: https://github.com/deployteam/laravel-polytranslate/actions?query=workflow%3ABuild
