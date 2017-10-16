<?php

class DATABASE {
		
	public function Create($DB){

		try {


			$servername = "localhost";
			$username = "root";
			$password = "";
			
			$conn = new PDO("mysql:host=$servername", $username, $password);
			
			$sql = "CREATE DATABASE ";
			
			$sql.=$DB;
			$conn->exec($sql);
			$conn2 = new PDO("mysql:host=$servername;dbname=$DB", $username, $password);
			$sql2 = file_get_contents("databaseTables.sql"); 
			$conn2->exec($sql2);
			echo "database created.";
			$conn = null;
			$conn2 = null;
		}catch(PDOException $e)
    {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
    }
}



	public function inserer(){
		
	}

}
 echo "hello world!";
 $az= new DATABASE;
 
 $az->Create("projet1");



 ?>