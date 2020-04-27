## Laravel PolyTranslate

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Total Downloads][ico-downloads]][link-downloads]

### Install
Require this package with composer using the following command:

```bash
composer require deployteam/laravel-polytranslate
```

After updating composer, add the service provider to the `providers` array in `config/app.php`

```php
DeployTeam\PolyTranslate\Providers\TranslationServiceProvider::class,
```

**>= Laravel 5.5** uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

### Usage

Using Polytranslate you can add multiple paths for a single language namespace:

```php
Lang::addNamespace('theme', 'themes/base/lang');
Lang::addNamespace('theme', 'themes/child/lang');
```

Laravel will start searching the directories for languages, and will merge anything it finds.

```php
// themes/base/lang/en.php
return [
    'greetings' => 'Hello',
    'login' => 'Login'
];
```

```php
// themes/child/lang/en.php
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

### License

The Laravel Polytranslate is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

[ico-version]: https://img.shields.io/packagist/v/deployteam/laravel-polytranslate.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/deployteam/laravel-polytranslate.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/deployteam/laravel-polytranslate
[link-downloads]: https://packagist.org/packages/deployteam/laravel-polytranslate
