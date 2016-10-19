<?php

namespace Klaravel\Settings\tests;

use Klaravel\Settings\Models\Setting as SettingModel;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class BaseTestCase extends OrchestraTestCase
{
    public function setUp()
    {
        parent::setUp();

        //$this->setUpDatabase();
        $this->migrateTables();
        $this->seedData();

        // Enabled query log for test
        \DB::enableQueryLog();
    }

    protected function getPackageProviders($app)
    {
        return ['\Klaravel\Settings\ServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Setting' => '\Klaravel\Settings\SettingsFacade',
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    public function migrateTables()
    {
        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--realpath' => realpath(__DIR__ . '/migrations'),
        ]);
    }

    public function seedData()
    {
        SettingModel::create(['key' => 'key1', 'value' => 'value1']);
        SettingModel::create(['key' => 'key2', 'value' => 'value2']);
        SettingModel::create(['key' => 'key3', 'value' => 'value3']);
        SettingModel::create(['key' => 'key4', 'value' => 'value4']);
    }
}
