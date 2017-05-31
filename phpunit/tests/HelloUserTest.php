<?php
namespace tests;
use common\hello;
use dtos\user;
use PHPUnit\Framework\TestCase;

class HelloUserTest extends TestCase
{
	public function setup()
	{
	}

	public function testCreateUser()
	{
	    $user = new user();
	    $user->id = "1F148206-6CE3-A315-0AB1-34E08FD8C253";
        $user->username = "2100228C-81B5-874A-F5E2-823106B1D078";
        $user->password = "9AE6E075-65EE-FC11-A468-FAC14F0DF6FB";

		$hello = new hello();
		$success = $hello->create_user($user);

		$this->assertTrue($success);
	}
}
