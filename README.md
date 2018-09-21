# php-fork-manager

A simple class to fork processes and handle multitasking tasks.

NOTE: I would suggest not to use PHP in forking processes or handling such a case. But if you are like me who were required to use PHP for some reason then feel free to use this.

## Installation
```
composer require dmkit/php-fork-manager
```
or in your composer.json
```
{
    "require": {
		"dmkit/php-fork-manager" : "dev-master"
    }
}

```

then run

```
composer update
```

## Usage

Fork processes and execute multi tasks.

```
$manager = new \Dmkit\Fork\Manager\Manager;

// Callback assigned as a worker should be a type hint of callable
// for more info about callable: http://php.net/manual/en/language.types.callable.php

// pass an anonymous function
$manager->addWorker( function(\Dmkit\Fork\Worker\Message\Message $msg) {

	echo "Child Process 1 - Started\n";

	for($i=1; $i <=5; $i++) {
		echo "$i\n";
	}

	echo "Child Process 1 - Ended\n\n";
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
	}
}

$mytaks = new MyTask;

$manager->addWorker([$mytaks, 'run']);

// run the workers
$manager->dispatch();

// execute another batch of processes after the first batch is done

$manager2 = new \Dmkit\Fork\Manager\Manager;

$manager2->addWorker( function(\Dmkit\Fork\Worker\Message\Message $msg) {

	echo "Child Process 1 - Started\n";

	for($i=1; $i <=5; $i++) {
		echo "$i\n";
	}

	echo "Child Process 1 - Ended\n\n";
});

$manager2->dispatch();

```

The callback gets an argument: Instance of \Dmkit\Fork\Worker\Message\Message. It is used to pass a message or data from a child process to the parent process.

```
$manager = new \Dmkit\Fork\Manager\Manager;

$manager->addWorker( function(\Dmkit\Fork\Worker\Message\Message $msg) {

	echo "Child Process 1 - Started\n";

	for($i=1; $i <=5; $i++) {
		echo "$i\n";
	}

	echo "Child Process 1 - Ended\n\n";

  // pass this message to parent process
  // you can pass any data type as the message
	$msg->set('Child Process 1 - Success');
});

// execute each callback in a forked process
$manager->dispatch();

// parse the message passed by the callbacks
// parse the messages passed in the workers
// it can be used to parse error messages or data output from child processes

$messages = $manager->getMessages();


// to get the passed data
foreach($messages as $msg) {
	echo "\n";
	print_r($msg->get());
}

```

This plugin requires the PCNTL extension (http://php.net/manual/en/function.pcntl-fork.php ).

Messages passed by the child processes are saved to memory using SHMOP extension ( https://packagist.org/packages/anime-db/shmop ) and anime-db/shmop (https://packagist.org/packages/anime-db/shmop) as the wrapper class.
