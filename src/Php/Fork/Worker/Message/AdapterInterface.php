<?php

namespace Dmkit\Php\Fork\Worker\Message;

/**
 * Dmkit\Php\Fork\Worker\Message\AdapterInterface.
 */
interface AdapterInterface
{
	public function set($message);

	public function get();

	public function remove();
}