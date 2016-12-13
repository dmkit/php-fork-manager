<?php

use PHPUnit\Framework\TestCase;

use Dmkit\Php\Fork\Worker\Message\Message;
use Dmkit\Php\Fork\Worker\AdapterInterface as Worker;

class MessageTest extends TestCase
{
	public function testReturn()
	{
		$worker = $this->createMock(Worker::class);

		$data = ['status' => 1, 'message'=>'yeah'];

		$message = new Message($data, $worker);

		$this->assertEquals($data, $message->get());
		$this->assertEquals(get_class($worker), $message->getInvoker());
	}
}