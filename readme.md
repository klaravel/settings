## General Settings Manager for Laravel 5.3+
[![Build Status](https://travis-ci.org/klaravel/settings.svg)](https://travis-ci.org/klaravel/settings)
[![Total Downloads](https://poser.pugx.org/klaravel/settings/d/total.svg)](https://packagist.org/packages/klaravel/settings)
[![Latest Stable Version](https://poser.pugx.org/klaravel/settings/v/stable.svg)](https://packagist.org/packages/klaravel/settings)
[![Latest Unstable Version](https://poser.pugx.org/klaravel/settings/v/unstable.svg)](https://packagist.org/packages/klaravel/settings)
[![License](https://poser.pugx.org/klaravel/settings/license.svg)](https://packagist.org/packages/klaravel/settings)

This module allow you to store settings into database with easy commands. You can store as many as settings and it will fetch settings with caching so only one database query and all settings will store into cache.

### Installation:

1. Run
   ```php
   composer require klaravel/settings
   ```     
   in console to install this module

2. Open `config/app.php` and in `providers` section add:
 
    ```php
    Klaravel\Settings\ServiceProvider::class,
    ```

    in `aliases` section add:

    ```php
    'Setting' => Klaravel\Settings\SettingsFacade::class,
    ```
3. Now generate the Settings migration:

    ```
    php artisan settings:migration

    // for migrate database
    php artisan migrate
    ```
    You will see migration file on you `/database/migrations/` folder.

### Usage:
Here's a quick example that shows how to use `Setting`:

```php
Setting::put('key', 'value');   // Insert settings into database
Setting::get('key');            // Get settings from database
Setting::has('key');            // Check key exits in database
Setting::forget('key');         // Delete key and value from database
```