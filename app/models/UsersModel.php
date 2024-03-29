<?php
declare(strict_types=1);

namespace simplerest\models;

use simplerest\core\Model;

class UsersModel extends Model
 { 
	protected $table_name = "users";
	protected $id_name = 'id';
	protected $fillable = [
							'email',
							'password',
							'firstname',
							'lastname',
							'enabled',
							'quota',
							'belongs_to'
	];
	protected $nullable = ['id', 'enabled', 'quota', 'belongs_to'];
	protected $hidden   = ['password', 'belongs_to'];

	/*
		Types are INT, STR and BOOL among others
		see: https://secure.php.net/manual/en/pdo.constants.php 
	*/
	protected $schema = [
		'id' => 'INT',
		'email' => 'STR',
		'password' => 'STR',
		'firstname' => 'STR',
		'lastname'=> 'STR',
		'enabled' => 'INT',
		'quota' => 'INT',
		'belongs_to' => 'INT'
	];

    public function __construct($db = NULL){
        parent::__construct($db);
    }
	
	function checkCredentials()
	{
		$pass = $this->password;
		
		$q  = "SELECT * FROM ".$this->table_name." WHERE email=?";
		$st = $this->conn->prepare($q);
		$st->execute([$this->email]);
	
		$row = $st->fetch(\PDO::FETCH_OBJ);
		
		if ($row){
			$hash = $row->password;

			if (password_verify($pass, $hash)){
				foreach ($row as $k => $field){
					$this->{$k} = $row->$k;
				}
				return true;
			}	
		}
		
		return false;
	}

	/*
		Usar password_hash / password_verify en su lugar
	*/
	function checkUserAndPass()
	{
		$q  = "SELECT * FROM ".$this->table_name." WHERE email=? AND password=?";
		$st = $this->conn->prepare($q);
		$st->execute([$this->email, sha1($this->password)]);
	
		$row = $st->fetch(\PDO::FETCH_OBJ);
		
		if ($row){
			foreach ($row as $k => $field){
				$this->{$k} = $row->$k;
			}
			return true;
		}
		
		return false;
	}
	
	/*
		@return array of all available roles for the user
	*/
	function fetchRoles()
	{
		$this->table_name = 'users as u';
		$this->join('user_role as ur', 'ur.user_id', '=', 'u.id');
		$rows = $this->filter(['ur.role_id as role'], ['u.id', $this->id]);

		if (!empty($rows)){
			$roles = [];
			foreach ($rows as $row){
				$roles[] = $row['role'];	
			}
			return $roles;
		}
	
		return [];
	}
	
}