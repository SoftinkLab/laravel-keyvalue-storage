<p align="center">
  <img src="https://i.ibb.co/hFY4LgG/laravel-keyvalue-storage.jpg" alt="laravel keyvalue storage">
</p>

<div align="center">
  
[![Latest Version on Packagist](https://img.shields.io/packagist/v/SoftinkLab/laravel-keyvalue-storage)](https://packagist.org/packages/softinklab/laravel-keyvalue-storage)
[![Total Downloads](https://img.shields.io/packagist/dt/SoftinkLab/laravel-keyvalue-storage)](https://packagist.org/packages/softinklab/laravel-keyvalue-storage)
[![Software License](https://img.shields.io/packagist/l/SoftinkLab/laravel-keyvalue-storage)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/SoftinkLab/laravel-keyvalue-storage)](https://travis-ci.com/SoftinkLab/laravel-keyvalue-storage)
  
</div>

## Introduction

Laravel Key Value Storage is an easy and simple package to store key-value data globally in Laravel. This package supports both Database and JSON File as storage methods. This package also comes with helper which simplify your key-value storage access in Code as well as in Blade Template.

## Installation

You can install the package via composer:

```bash
composer require softinklab/laravel-keyvalue-storage
```

### Setup

This package supports the auto-discovery feature of Laravel 5.5 and above, So skip these Setup instructions if you're using Laravel 5.5 and above.

In `config/app.php` add the following :

1 - Service Provider to the providers array :

```php
SoftinkLab\LaravelKeyvalueStorage\KeyValueStorageServiceProvider::class,
```

2 - Class alias to the aliases array :

```php
'KVOption' => SoftinkLab\LaravelKeyvalueStorage\Facades\KVOption::class,
```

3 - Publish the config file

```ssh
php artisan vendor:publish --provider="SoftinkLab\LaravelKeyvalueStorage\KeyValueStorageServiceProvider"
```

4 - Migrate database tables

```ssh
php artisan migrate
```

### Configuration

You can change the settings in `config/kvstorage.php`.

Example : Databse Storage
```
'method' => 'database',
'table_name' => 'kv_storage',
```

Example : File Storage
```
'method' => 'file',
'disk' => 'local',
'path' => 'kvstorage/',
```

## Usage

### Using FACADE

```php
use SoftinkLab\LaravelKeyvalueStorage\Facades\KVOption;

// Check is the option exists. Return true if found.
KVOption::exists('key');

// Get the option value.
KVOption::get('key');

// Get the option value. Default value is optional. If option not found default value is returned.
KVOption::get('key', 'default value');

// Add new option. Comment is optional. Comment is only working in Database Mode.
KVOption::set('key', 'value', 'comment');

// Add multiple options.
// Example Input => [['key1', 'value1', 'comment1'],['key2', 'value2', 'comment2']]
KVOption::setArray('array');

// Increment the value of a given key and return it as integer. Factor is used to determine the step. Default is one.
KVOption::increment('key', 'factor');

// Decrement the value of a given key and return it as integer. Factor is used to determine the step. Default is one.
KVOption::decrement('key', 'factor');

// Delete an option
KVOption::remove('key');
```

### Using Helper

```php
// Check is the option exists. Return true if found.
kvoption_exists('someKey');

// Get the option value.
kvoption('key');

// Get the option value. Default value is optional. If option not found default value is returned.
kvoption('key', 'default value');

// Add new option. Comment is optional. Comment is only working in Database Mode.
kvoption(['key','value', 'comment']);

// Add multiple options.
// Example Input => [['key1', 'value1', 'comment1'],['key2', 'value2', 'comment2']]
kvoption('array');
```
### Blade Templates

You can use `kvoptions()` helper to access key-values in Blade Templates.

```php
{{kvoption('key')}}
```

### Console

There are some console commands to perform actions.

**Create an Option**
```bash
php artisan kvoption:create {key} {value} --comment={comment}
```
*comment is optional.*

**Delete an Option**
```bash
php artisan kvoption:delete {key}
```

## Credits

This package is inspired by,
- [spatie/valuestore](https://github.com/spatie/valuestore) by Spatie
- [appstract/laravel-options](https://github.com/appstract/laravel-options) by Appstract

## Contributing

Contributions are welcome! Please refer [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

Laravel Key Value Storage is open-sourced software licensed under the [MIT License](LICENSE.md).
