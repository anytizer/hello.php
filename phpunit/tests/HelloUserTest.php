<?php
namespace tests;
use common\hello;
use PHPUnit\Framework\TestCase;

class HelloUserTest extends TestCase
{
	public function setup()
	{
	}

	public function testCreateUser()
	{
		$hello = new hello();
		$hello->create_user();
	}
}
