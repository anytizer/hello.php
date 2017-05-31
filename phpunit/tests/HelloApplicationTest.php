<?php
namespace tests;
use common\guid;
use common\hello;
use dtos\application;
use dtos\user_application;
use PHPUnit\Framework\TestCase;

class HelloApplicationTest extends TestCase
{
	public function setup()
	{
	}

	public function testCreateApplication()
	{
	    $application = new application();
	    $application->id = "D8451997-9ECD-2106-8F9B-E9A18C1EACC7";
        $application->key = (new guid())->NewGuid();
        $application->secret = (new guid())->NewGuid();
        $application->name = (new guid())->NewGuid();

		$hello = new hello();
		$success = $hello->create_application($application);

        $this->assertTrue($success);
	}
	
	public function testCreateApplicationUser()
	{
        # @todo Replace with the IDs that were just created
	    $user_application = new user_application();
        $user_application->user = "1F148206-6CE3-A315-0AB1-34E08FD8C253";
        $user_application->application = "D8451997-9ECD-2106-8F9B-E9A18C1EACC7";

	    $hello = new hello();
		$success = $hello->create_user_application($user_application);

        $this->assertTrue($success);
	}
}
