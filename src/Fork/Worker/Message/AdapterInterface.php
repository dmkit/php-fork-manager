<?php

namespace Dmkit\Fork\Worker\Message;

/**
 * Dmkit\Fork\Worker\Message\AdapterInterface.
 */
interface AdapterInterface
{
	public function set($message);

	public function get();

	public function remove();
}