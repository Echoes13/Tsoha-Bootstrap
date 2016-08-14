<?php

class Trainer extends BaseModel {
	
	public $id, $name, $password, $level, $caught;

	public function __construct($attributes){
		parent::__construct($attributes);
	}


	//Tarkistetaan käyttäjä

	public static function authenticate($name, $password){
		$query = DB::connection()->prepare('SELECT * FROM Trainer WHERE name =:name AND password =:password LIMIT 1');
		$query->execute(array('name' => $name, 'password' => $password));
		$row = $query->fetch();

		if($row){
			$trainer = new Trainer(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'password' => $row['password'],
				'level' => $row['level'],
				'caught' => $row['caught']
				));

			return $trainer;
			
		}else{		
			return null;
		}
	}


	//Etsitään käyttäjiä

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Trainer');
		$query->execute();
		$rows = $query->fetchAll();
		$trainers = array();

		foreach($rows as $row){
			$trainers[] = new Trainer(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'password' => $row['password'],
				'level' => $row['level'],
				'caught' => $row['caught']
				));
		}

		return $trainers;
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Trainer WHERE id =:id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$trainer = new Trainer(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'password' => $row['password'],
				'level' => $row['level'],
				'caught' => $row['caught']
				));

			return $trainer;
		}

		return null;
	}
}