<?php

namespace Klaravel\Settings\tests;

class BasicTest extends BaseTestCase
{
    /** @test */
    public function set_value_and_check_value_exists()
    {
        // Check value exists
        $this->assertTrue(\Setting::has('key1'));

        // Check value not exitst should return false
        $this->assertFalse(\Setting::has('dummy'));

        // Get value exitst and return value
        $this->assertEquals(\Setting::get('key1'), 'value1');

        // Store value and get value
        \Setting::put('name', 'Test Name');
        $this->assertTrue(\Setting::has('name'));
        $this->assertEquals(\Setting::get('name'), 'Test Name');

        // Forget value and check
        \Setting::forget('name');
        $this->assertNull(\Setting::get('name'));
        $this->assertFalse(\Setting::has('name'));
    }

    /** @test */
    public function get_value_should_come_from_cache()
    {
        // query 1
        \Setting::get('key1');
        \Setting::get('key2');
        \Setting::get('key3');
        \Setting::get('key4');

        // query 2
        \Setting::put('key5', 'value5');
        // query 3
        \Setting::get('key5');
        \Setting::has('key5');
        \Setting::get('key5');

        // query 4
        \Setting::forget('key5');
        // query 5
        \Setting::get('key5');
        \Setting::get('key1');
        \Setting::has('key2');

        $queries = \DB::getQueryLog();

        $this->assertCount(5, $queries);
    }
}
