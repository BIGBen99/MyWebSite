<?php

class DatabaseConnection {
	  public ?PDO $database = null;

	  public function getConnection($dsn, $username, $password): PDO {
    	  if ($this->database === null) {
        	  $this->database = new PDO($dsn, $username, $password);
    	  }

    	  return $this->database;
	  }
}
