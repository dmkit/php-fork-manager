<?php

namespace Dmkit\Php\Fork\Worker;

use Dmkit\Php\Fork\Worker\Message\AdapterInterface as Message;

/**
 * Dmkit\Php\Fork\Worker\AdapterInterface.
 */
interface AdapterInterface
{
	public function run();

	public function getMessage(): Message;

	public function hasMessage(): bool;
}