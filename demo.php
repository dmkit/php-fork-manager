<?php

require 'vendor/autoload.php';

$manager = new \Dmkit\Fork\Manager\Manager;


// you can pass any callable to the addWorker function
// for more info about callable - http://php.net/manual/en/language.types.callable.php

// pass an anonymous function
$manager->addWorker( function(\Dmkit\Fork\Worker\Message\Message $msg) {

	echo "Child Process 1 - Started\n";

	for($i=1; $i <=5; $i++) {
		echo "$i\n";
	}

	echo "Child Process 1 - Ended\n\n";

	$msg->set('Child Process 1 - Success');
});

// pass an object
class MyTask 
{
	public function run(\Dmkit\Fork\Worker\Message\Message $msg) {
		echo "Child Process 2 - Started\n";

		for($i=1; $i <=5; $i++) {
			echo "$i\n";
		}

		echo "Child Process 2 - Ended\n\n";

		$msg->set(['success'=>1, 'workerName'=> 'MyTask']);
	}
}

$mytaks = new MyTask;

$manager->addWorker([$mytaks, 'run']);

// run the workers
$manager->dispatch();

// parse the messages passed in the workers for error checking or whatever you want
$messages = $manager->getMessages();

foreach($messages as $msg) {
	echo "\n";
	print_r($msg->get());
}
