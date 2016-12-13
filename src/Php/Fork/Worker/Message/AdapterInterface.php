<?php

namespace Dmkit\Php\Fork\Worker\Message;

use Dmkit\Php\Fork\Worker\AdapterInterface as Worker;

/**
 * Dmkit\Php\Fork\Worker\Message\AdapterInterface.
 */
interface AdapterInterface
{
	public function get(): array;

	public function set(array $message);

	public function setInvoker(Worker $worker);

	public function getInvoker(): string;
}