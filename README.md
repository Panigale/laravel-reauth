# Laravel ReAuth

[![Build Status](https://travis-ci.org/gocrew/laravel-reauth.svg)](https://travis-ci.org/gocrew/laravel-reauth)
[![Latest Stable Version](https://poser.pugx.org/gocrew/laravel-reauth/v/stable)](https://packagist.org/packages/gocrew/laravel-reauth)
[![Latest Unstable Version](https://poser.pugx.org/gocrew/laravel-reauth/v/unstable)](https://packagist.org/packages/gocrew/laravel-reauth)
[![License](https://poser.pugx.org/gocrew/laravel-reauth/license)](https://packagist.org/packages/gocrew/laravel-reauth)

Re-Auth users for sensitive parts of your app.

## Installation

### Step 1: Composer

From the command line, run:

```
composer require gocrew/laravel-reauth
```

### Step 2: Service Provider

For your Laravel app, open `config/app.php` and, within the `providers` array, append:

```
gocrew\LaravelReAuth\ServiceProvider::class
```

This will bootstrap the package into Laravel.

### Step 3: The Middleware

In your `app\Http\Kernel.php` file, add the reauth middleware to the `$routeMiddleware` array.

```php
protected $routeMiddleware = [
    // ...
    'reauth'         => \gocrew\LaravelReAuth\Http\Middleware\Reauthenticate::class,
    // ...
];
```

## Usage

### Basic

Apply the middleware on a route you want to protect:

```php
Route::get('settings', ['uses' => 'Controller@getSettings', 'middleware' => 'reauth']);
```

Done!

### Advanced

If you need a more advanced setup, no problem. Everything is overwritable and everything is as modular as possible.

## TODO
 - advanced docs
 - tests

## License

The contents of this repository is released under the [MIT license](http://opensource.org/licenses/MIT).
