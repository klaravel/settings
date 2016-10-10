<?php

use Illuminate\Database\Capsule\Manager as DB;
use Klaravel\Settings\Models\Setting as SettingModel;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->setUpDatabase();
        $this->migrateTables();
    }

    protected function setUpDatabase()
    {
        $database = new DB;

        $database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $database->bootEloquent();
        $database->setAsGlobal();
    }

    protected function migrateTables()
    {
        DB::schema()->create('settings', function ($table) {
            $table->increments('id');
            $table->string('key')->unique()->index();
            $table->text('value');
            $table->timestamps(); 
        });
    }

    protected function seed()
    {
        SettingModel::create(['key' => 'key1', 'value' => 'value1']);
        SettingModel::create(['key' => 'key2', 'value' => 'value2']);
        SettingModel::create(['key' => 'key3', 'value' => 'value3']);
        SettingModel::create(['key' => 'key4', 'value' => 'value4']);
    }
}