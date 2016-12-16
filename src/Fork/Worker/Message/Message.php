<?php

namespace Dmkit\Fork\Worker\Message;

use Dmkit\Fork\Worker\Message\AdapterInterface;
use Dmkit\Fork\Worker\Message\ShmopHandler;

/**
 * Dmkit\Fork\Worker\Message\Message.
 */
class Message implements AdapterInterface
{
	public static $shmopSize = 1000;

	public $key;

	protected $shmopObj;

	public function __construct()
	{
		$this->key = round( microtime(true) * rand(500,1000) );

		$this->shmopObj = new ShmopHandler($this->key, self::$shmopSize);
	}

	public function set($msg)
	{
		$msg = serialize($msg);
		return $this->shmopObj->write($msg);
	}

	public function get()
	{
		return unserialize( $this->shmopObj->read() );
	}

	public function remove()
	{
		$deleted = $this->shmopObj->delete();
		$this->shmopObj->close();

		return $deleted;
	}
}