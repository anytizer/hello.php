<?php
namespace tests;
use common\hello;
use PHPUnit\Framework\TestCase;

class HelloTest extends TestCase
{
	public function setup()
	{
	}

	public function testCreateUser()
	{
		$hello = new hello();
		$hello->create_user();
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
	
	public function testCreateToken()
	{
		$hello = new hello();
		$hello->create_applicaton_token();
	}
}
