<?php

include('api/DB_API.php');



class MembreAPI
{


    protected $servername="localhost";
    protected $username="root";
    protected $password="";
    protected $dbname = "vap1_test";
    private $conn;
    
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection($this->dbname);
        $this->conn = $db;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function is_loggedin()
    {
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }
    public function redirect($url)
    {
        header("Location: $url");
    }
    public function insertMembre($DB, $nomMembre, $prenomMembre,$username, $mdpMembre, $email, $membreEntreprise){
        $DB = $this->dbname;
        try {
            $sql3 = "insert into membre (`idMembre`, `nomMembre`, `prenomMembre`, `mdpMembre`, `emailMembre`, `idEntreprise`) values(NULL,'$nomMembre','$prenomMembre','$mdpMembre','$email','$membreEntreprise')";
            $conn3 = new PDO("mysql:host=$this->servername;dbname=$DB", $this->username,$this->password);
            $stmt = $conn3->prepare($sql3);
            $stmt->execute();
            unset($conn3);
            echo "success";
            return $stmt;
        } catch (PDOException $es) {
            echo "error!!";
        }
    }

    public function getMembres($DB, $extras = '') {
        $DB = $this->dbname;
        global $dbconnect;
        $conn = $dbconnect->dbConnection($DB);
        if($conn!= null){
            $query = @sprintf("SELECT * FROM membre %s", $extras) ;
            $res = $conn->query($query);



        }
    }

    public function getMembres_byID($DB, $idMembre)
    {
        $DB = $this->dbname;
    }

    public function selectMembre($DB, $mdpMembre, $email)
    {
        $DB = $this->dbname;
        try {
            $sql3 = "select * from membre where emailMembre='$email' and mdpMembre='$mdpMembre'";
            $conn3 = new PDO("mysql:host=$this->servername;dbname=$DB", $this->username, $this->password);
            $result = $conn3->query($sql3);
            if ($result->rowCount() == 1) echo "done";
            unset($result);
        } catch (PDOException $es) {
            echo "get membre error" . $es->getMessage();
        }
    }


    public function updateMembre($Membreemail, $DB, $nomMembre, $prenomMembre, $mdpMembre, $emailMembre, $telMembre)
    {
        $DB = $this->dbname;
        try {
            $conn3 = new PDO("mysql:host=$this->servername;dbname=$DB", $this->username, $this->password);
            $sql1 = "select * from membre where emailMembre='$Membreemail'";
            $stmt = $conn3->prepare($sql1);
            $result = $conn3->query($sql1);
            if ($result->rowCount() > 0) {
                $row = $conn3->fetch();
                $id = $row[0];
                echo "$id";
            }
            $sql3 = "update membre set nomMembre ='$nomMembre' and prenomMembre = '$prenomMembre' and mdpMembre = '$mdpMembre' and emailMembre = '$emailMembre' and telMembre = '$telMembre' where idMembre = '$id";
            $stmt = $conn3->prepare($sql3);
            echo "zzz";
            $stmt->execute();
            unset($conn3);
            unset($result);
        } catch (PDOException $es) {
            echo "Error connection";
        }
    }

}

$mbre = new MembreAPI();
/*$az = new DB_API();
$az->dbConnection("vap1_test");*/ 
//$mbre->insertMembre("projet", "ben zekri","nourreddine","nbenz", "azerty","noure@gmail.com","0645342466");
?>