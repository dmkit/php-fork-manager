<?php

namespace Dmkit\Php\Fork\Worker;

use Dmkit\Php\Fork\Worker\AdapterInterface;
use Dmkit\Php\Fork\Worker\Message\Message as Message;

/**
 * Dmkit\Php\Fork\Worker\Adapter.
 */
abstract class Adapter implements AdapterInterface
{
	protected $message;

	abstract public function run();

	protected function setMessage(array $message)
	{
		$this->message = new Message($message, $this);
	}

	public function getMessage(): Message
	{
		return $this->message;
	}

	public function hasMessage(): bool
	{
		return isset($this->message);
	}
}