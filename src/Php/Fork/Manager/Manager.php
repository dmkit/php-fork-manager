<?php

namespace Dmkit\Php\Fork\Manager;

use Dmkit\Php\Fork\Manager\Adapter;
use Dmkit\Php\Fork\Worker\Message\Message;

/**
 * Dmkit\Php\Fork\Manager\Manager.
 */
class Manager extends Adapter
{
    // store message objects
	protected $msgs = [];

   	// need to know who is the parent process
   	protected $isParent = 1;

    public function getMessages()
    {
        return $this->msgs;
    }

    protected function getMessage()
    {
    	$msg = new Message;
    	$this->msgs[] = $msg;
    	return $msg;
    }

    public function dispatch()
    {
    	foreach($this->workers as $worker) {

    		// set the message handler
    		$msg = $this->getMessage();

    		// fork the process
    		$pid = pcntl_fork();
    		
    		if($pid == -1) {
    			// can't fork
    			throw new \Exception("Can't fork process. Check PCNTL extension.");
    		} else if($pid) {
    			// parent
    			$this->pids[] = $pid;
    		} else {
    			// child
    			$this->isParent = 0;
    			call_user_func_array($worker, [$msg]);
    			exit;
    		}
    	}

    	//let's wait for the children
    	foreach($this->pids as $pid) {
            pcntl_waitpid($pid, $status, WUNTRACED);
        }
    }

    // let's do the cleanup
    public function __destruct()
	{
		if( !$this->isParent) {
			return;
		}

		foreach($this->msgs as $msg) {
			$msg->remove();
		}
	}
}