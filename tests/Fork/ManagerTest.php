<?php

use PHPUnit\Framework\TestCase;

use Dmkit\Php\Fork\Manager\Manager;

class ManagerTest extends TestCase
{
	public function testFork()
	{

		$status1 = ['success'=>1, 'error'=>'error'];
		$status2 = ['success'=>1, 'error'=>'error2'];
		$status3 = ['success'=>1, 'error'=>'error3'];

		$manager = new Manager;
		
		$manager->addWorker(function($msg) use($status1) {
			$msg->set($status1);
		});

		$manager->addWorker(function($msg) use($status2) {
			$msg->set($status2);
		});

		$class1 = new class{
			public function run($msg) {
				$msg->set(['success'=>1, 'error'=>'error3']);
			}
		};

		$manager->addWorker([$class1, 'run']);

		$manager->dispatch();

		$msgs = $manager->getMessages();

		$this->assertEquals($status1, $msgs[0]->get());
		$this->assertEquals($status2, $msgs[1]->get());
		$this->assertEquals($status3, $msgs[2]->get());
	}
}