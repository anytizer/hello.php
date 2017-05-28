<?php
namespace tests;
use common\hello;
use PHPUnit\Framework\TestCase;

class HelloApplicationTest extends TestCase
{
	public function setup()
	{
	}

	public function testCreateApplication()
	{
		$hello = new hello();
		$hello->create_user();
	}
	
	public function testCreateApplicationUser()
	{
		$hello = new hello();
		$hello->create_application_user();
	}
}
