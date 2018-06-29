<?php

class MyUserClass
{

	private dbconn;

	function __construct()
	{
		$this->dbconn = new DatabaseConnection('localhost','user','password');
	}

	public function getUserList()
	{
		return $this->$dbconn->query('SELECT name FROM user ORDER BY name');
	}
}