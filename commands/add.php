<?php


function addCommand(array $arguments)
{
	$fileContent = array_shift($arguments);

	$todo =
		[
			'id' => uniqid(),
			'title' => $fileContent,
			'completed' => false,
			'created_at' => time(),
			'updated_at' => null,
			'completed_at' => null,
		];


	$todos = getTodos();
	$todos[] = $todo;

	storeTodos($todos);
}
