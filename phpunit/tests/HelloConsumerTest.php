<?php
namespace tests;
use common\guid;
use common\hello;
use dtos\consumer;
use PHPUnit\Framework\TestCase;

class HelloConsumerTest extends TestCase
{
    public function testCreateConsumer()
    {
        $consumer = new consumer();
        $consumer->id = "84DEAA52-2ACF-22F1-6943-55985444DB19";
        $consumer->application = "84DEAA52-2ACF-22F1-6943-55985444DB19";
        $consumer->key = "6C1BC652-DE0A-7D6C-88E3-E49810332F3B";
        $consumer->key = (new guid())->NewGuid();
        $consumer->secret = (new guid())->NewGuid();
        $consumer->name = "Consumer name";

        $hello = new hello();
        $success = $hello->create_consumer($consumer);

        $this->assertTrue($success);
    }
}
