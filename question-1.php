<?php

class Question1 
{
	function __construct()
	{
		for ($i = 1; $i <= 100; $i++) 
		{
			$buffer = ($i % 3 == 0 ? 'Fizz' : '');
			$buffer .= ($i % 5 == 0 ? 'Buzz' : '');
			echo $buffer ? : $i;
		}
	}

}

$class = new Question1();