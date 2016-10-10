<?php namespace Klaravel\Settings;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for laravel
 */
class SettingsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'settings';
    }
}