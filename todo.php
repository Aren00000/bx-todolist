<?php

function main(array $arguments): void
{
	array_shift($arguments);

	$command = array_shift($arguments);

	switch ($command)
	{
		case 'list':
			listCommand($arguments);
			break;
		case 'add':
			addCommand($arguments);
			break;
		case 'complate':
			complateCommand($arguments);
			break;
		case 'remove':
		case 're':
			removeCommand($arguments);
			break;

		default:
			echo 'unknown command';
			exit(1);
	}
	exit(0);
}


function addCommand(array $arguments)
{
	$fileContent = array_shift($arguments);
	$fileName = date('Y-m-d') . '.txt';
	$filePath = __Dir__ . '/data/' . $fileName;

	$todo =
		[
			'id' => uniqid(),
			'title' => $fileContent,
			'completed' => false,
		];

	if(file_exists($filePath)) {
		$content = file_get_contents($filePath);
		$todos = unserialize($content, ['allowed_classes' => false]);

		$todos[] = $todo;
		file_put_contents($filePath, serialize($todos));
	}
	else
	{
		$todos = [$todo];
		file_put_contents($filePath,serialize($todos));

	}

}
function removeCommand(array $arguments)
{

}

function complateCommand(array $arguments)
{

}

function listCommand(array $arguments)
{
	$fileName = date('Y-m-d') . '.txt';
	$filePath = __Dir__ . '/data/' . $fileName;

	if(!file_exists($filePath))
	{
		echo 'file not found';
		return;
	}
	$content = file_get_contents($filePath);
	$todos = unserialize($content, ['allowed_classes' => false]);

	if (empty($todos))
	{
		echo 'file not found';
		return;
	}


	foreach ($todos as $index => $todo)
		{
			echo sprintf("%s.[%s] %s\n",
			($index + 1),
			$todo['completed'] ? 'x' : '',
			$todo['title']

			);
		}
}

main($argv);
