<?php

namespace Dmkit\Php\Fork\Worker\Message;

use Dmkit\Php\Fork\Worker\AdapterInterface as Worker;
use Dmkit\Php\Fork\Worker\Message\AdapterInterface;

/**
 * Dmkit\Php\Fork\Worker\Message\Adapter.
 */
abstract class Adapter implements AdapterInterface
{
	protected $message;
	protected $invoker;

	public function setInvoker(Worker $worker)
	{
		$this->invoker = get_class($worker);
	}

	public function getInvoker(): string
	{
		return $this->invoker;
	}

	public function set(array $message) 
	{
		$this->message = $message;
	}

	public function get(): array
	{
		return $this->message;
	}

}