<?php 

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;

class BasicTest extends TestCase
{
	/** @test */
	public function get_value_from_key()
	{
		$this->assertTrue(true);
	}
}