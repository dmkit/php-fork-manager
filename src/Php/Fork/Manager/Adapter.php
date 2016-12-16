<?php

namespace Dmkit\Php\Fork\Manager;

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

    public function addWorker(callable $worker) {
        $this->workers[] = $worker;
    }

    abstract public function dispatch();

}