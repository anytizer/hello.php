<?php
namespace tests;
use common\hello;
use dtos\token;
use PHPUnit\Framework\TestCase;

class HelloTokenTest extends TestCase
{
    public function testCreateToken()
    {
        $hello = new hello();

        $token = new token();
        $token->id = "";
        $token->consumer = "";
        $token->ip = "";
        $token->isp = "";

        $hello->create_token($token);

        $this->assertTrue(false);
    }
}