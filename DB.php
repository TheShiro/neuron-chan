<?php

class DB 
{

	public $db;

	public function __construct()
	{
		$dsn = $this->dsn();
		$this->db = new PDO($dsn['dsn'], $dsn['user'], $dsn['pass']);
	}

	public function select(string $sql, array $params = [])
	{
		$query = $this->db->prepare($sql);
		$query->execute($params);

		return $query;
	}

	private function dsn()
	{
		return [
			'dsn' => 'mysql:host=localhost;dbname=neuronchan;charset=utf8',
			'user' => 'root',
			'pass' => ''
		];
	}
}

?>