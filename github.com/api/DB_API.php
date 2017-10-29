<?php

class Database
{

    protected $servername="localhost";
    protected $username="root";
    protected $password="";


    public function CreateDatabase($DB){
        try {
            $conn = new PDO("mysql:host=$this->servername", $this->username, $this->password);
            $sql = "CREATE DATABASE " . $DB;
            $conn->exec($sql);
            echo "DATABASE $DB has created succefuly </br> ";
            $dbConn = new PDO("mysql:host=$this->servername;dbname=$DB", $this->username, $this->password);
            $dbConn->exec("USE $DB");
            $sql2 = file_get_contents("DataBAse.sql");
            $dbConn->exec($sql2);
            echo "Tables of $DB DATABASE have created succefuly";
            unset($conn);
            unset($dbConn);
        } catch (PDOException $e) {
            echo "<br> DB error " . $e->getMessage();
        }
    }
    public function DropDatabase($DB){

        try {           
            $conn = new PDO("mysql:host=$this->servername", $this->username, $this->password);
            $sql = "DROP DATABASE ". $DB;
            $conn->exec($sql);
            echo "DATABASE $DB has been deleted succefuly";          
            unset($conn);
        } catch (PDOException $e) {
            echo                "<br> DB error". $e->getMessage();
        }
    }
    public function dbConnection($dbName){
        $this->conn = null;    
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $dbName, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        //    echo "Connection done";  
        }
        catch(PDOException $exception)
        {
            echo "<br>db Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

//$az = new Database;
//echo "obj created.<br>";
//$az->CreateDatabase("vap1_test");
//$az->dbConnection("vap1_test");
// $az->insertMembre("projet1","Ben Zekri","Noureddine","azerty","Noure@gmail.com","0654324355");
// $az->selectMembre("projet1","azerty","Noure@gmail.com");
//$az->updateMembre("Noure@gmail.com", "projet1", "Ben", "Noureddine", "azerty", "Noure@gmail.com", "0666666");
?>