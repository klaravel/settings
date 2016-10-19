<?php

namespace Klaravel\Settings;

/**
 * Laravel service provider for default bind and load things.
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Migration commaon for install settings table
     * @var array
     */
    protected $commands = [
        'Klaravel\Settings\Commands\MigrationCommand',
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Register facade
        $this->app->singleton('settings', function () {
            return $this->app->make('Klaravel\Settings\SettingHelper');
        });

        // Register commands
        $this->commands($this->commands);
    }
}
