<?php
namespace tests;
use common\hello;
use PHPUnit\Framework\TestCase;

class HelloConsumerTest extends TestCase
{
    public function testCreateToken()
    {
        $hello = new hello();
        $hello->create_applicaton_token();
    }
}
