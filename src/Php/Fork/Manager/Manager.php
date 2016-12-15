<?php

namespace Dmkit\Php\Fork\Manager;

use Dmkit\Php\Fork\Manager\Adapter;

/**
 * Dmkit\Php\Fork\Manager\Manager.
 */
class Manager extends Adapter
{
    // store message objects
    protected $msgs = [];

    public function dispatch()
    {

    }

    public function getMessages()
    {
        return $this->msgs;
    }
}