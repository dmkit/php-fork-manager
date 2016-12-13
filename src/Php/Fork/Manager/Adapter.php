<?php

namespace Dmkit\Php\Fork\Manager;

use Dmkit\Php\Fork\Worker\AdapterInterface as Worker;

/**
 * Dmkit\Php\Fork\Manager\Adapter.
 */
abstract class Adapter 
{

	protected $pids = [];

    protected $workers = [];

    // seconds
    public static $dispatchInterval = 0;

    protected function pause() {
        if ( self::dispatchInterval ) {
            sleep(self::dispatchInterval);
        }
    }

    public function addWorker(Worker $worker) {
        $this->workers[] = $worker;
    }

    protected function waitWorkers() 
    {
    	foreach($this->pids as $pid) {
            pcntl_waitpid($pid, $status);
        }
    }

    abstract public function dispatch();

}