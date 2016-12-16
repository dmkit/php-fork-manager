<?php

namespace Dmkit\Fork\Worker\Message;

use AnimeDb\Shmop\FixedBlock;

/**
 * Dmkit\Fork\Worker\Message\ShmopHandler.
 */
class ShmopHandler extends FixedBlock
{
	/**
	 * Add our own close method and manually call it.
	 */
	public function close()
	{
		shmop_close($this->shmid);
	}

	/**
	 * Override the parent method
	 * Need to keep the memory block open for the parent process
	 */ 
	public function __destruct()
	{
		// do nothing
	}
}