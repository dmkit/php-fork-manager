<?php

namespace Dmkit\Php\Fork\Worker\Message;

use AnimeDb\Shmop\FixedBlock;

/**
 * Dmkit\Php\Fork\Worker\Message\ShmopHandler.
 */
class ShmopHandler extends FixedBlock
{
	/**
	 * Add our own close method to manually call it.
	 */
	public function close()
	{
		shmop_close($this->shmid);
	}

	/**
	 * override the parent method
	 * Need to keep the memory block open for the parent process
	 */ 
	public function __destruct()
	{
		// do nothing
	}
}