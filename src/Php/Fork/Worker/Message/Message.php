<?php

namespace Dmkit\Php\Fork\Worker\Message;

use Dmkit\Php\Fork\Worker\Message\Adapter;

/**
 * Dmkit\Php\Fork\Worker\Message\Message.
 */
class Message extends Adapter
{
	public function __construct($message, $worker)
	{
		$this->set($message);
		$this->setInvoker($worker);
	}

}