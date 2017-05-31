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
        $token->id = "C67656D5-F1B6-249C-DAB5-45FCCC3C56FD";
        $token->consumer = "84DEAA52-2ACF-22F1-6943-55985444DB19";
        $token->ip = "127.0.0.1";
        $token->isp = "localhost";

        $success = $hello->create_token($token);
        $this->assertTrue($success);
    }
}