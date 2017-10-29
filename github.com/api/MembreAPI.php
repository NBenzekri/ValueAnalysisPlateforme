<?php

include('DB_API.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';
require 'mailBody.php';

class MembreAPI
{
    protected $servername="localhost";
    protected $username="root";
    protected $password="";
    protected $dbname = "vap1_test";
    private $conn;
    protected $Mtoken;
    protected $errorMail = [];
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection($this->dbname);
        $this->conn = $db;
        $this->Mtoken = "";
    }

    public function runQuery($sql){
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function is_loggedin(){
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
        return false;
    }
    public function doLogout(){
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }
    public function redirect($url)    {
        header("Location: $url");
    }

    public function getToken(){
        return $this->Mtoken;
    }
    public function setToken($token){
        $this->Mtoken = $token;
    }
    public function insertMembre($nomMembre, $prenomMembre, $mdpasseMembre, $email, $idEntreprise){
        $DB = $this->dbname;
        try {
            //create a random key
            $mdpMembre = md5($mdpasseMembre);
            $key = $nomMembre . $email . date('mY');
            $token = md5($key);
            $sql3 = "insert into membre (`nomMembre`, `prenomMembre`, `mdpMembre`, `emailMembre`,`activationToken`, `idEntreprise`) values('$nomMembre','$prenomMembre','$mdpMembre','$email','$token','$idEntreprise')";
            $conn3 = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username,$this->password);
            $this->setToken($token);
            $stmt = $conn3->prepare($sql3);
            $stmt->execute();
            $id = $conn3->lastInsertId();
            unset($conn3);
            return $stmt;
        } catch (PDOException $es) {
            $this->errorMail[] = "insert Membre Error:";
        }
    }
    public function doLogin($emailMembre,$idEntreprise,$mdpMembre)
{
    try
    {
        $passmd5 = md5($mdpMembre);
        $stmt = $this->conn->prepare("SELECT * FROM membre WHERE idEntreprise=:idEntre AND emailMembre=:umail");
        $stmt->execute(array(':idEntre'=>$idEntreprise, ':umail'=>$emailMembre));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() == 1)
        {
            if($passmd5 == $userRow['mdpMembre'])
            {
                $_SESSION['idMembre'] = $userRow['idMembre'];
                $_SESSION['nomMembre'] = $userRow['nomMembre'];
                $_SESSION['prenomMembre'] = $userRow['prenomMembre'];
                $_SESSION['mdpMembre'] = $userRow['mdpMembre'];
                $_SESSION['emailMembre'] = $userRow['emailMembre'];
                $_SESSION['telMembre'] = $userRow['telMembre'];
                $_SESSION['fonctionMembre'] = $userRow['fonctionMembre'];
                $_SESSION['roleMembre'] = $userRow['roleMembre'];
                $_SESSION['activationToken'] = $userRow['activationToken'];
                $_SESSION['compteActive'] = $userRow['compteActive'];
                echo "session ouvert";
                echo "<br> ".$_SESSION['mdpMembre'];
                echo "<br> ".$_SESSION['nomMembre'];
                echo "<br> ".$_SESSION['prenomMembre']."<br>";
                return true;
            }
            else
            {   echo "password not match";
                return false;
            }
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}
    public function sendConfirmationEmail($password,$name,$prenomMembre, $email,$idEntreprise, $token){

        $mail = new PHPMailer(true);
        try {
            $sql = "SELECT * FROM entreprise WHERE idEntreprise=:idEntre";
            $stmt = $this->runQuery($sql);
            $stmt->execute(array(':idEntre'=>$idEntreprise));
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            $NomEntreprise =  $row['nomEntreprise'];
        $subject = 'Cloud-VAP Signup | Verification'; // Give the email a subject 
        $link =  "http://localhost/ValueAnalysisPlateforme/github.com/verify.php?email=".$email."&idEntreprise=".$idEntreprise."&token=".$token;
    //Server settings
    $mail->SMTPDebug = 0;           // Enable verbose debug output, show debugging 1 sever, 2 client and server, 0 none
    $mail->isSMTP();         // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = "cloudvapensias@gmail.com";
    $mail->Password = "@cloudvapensias";                         // SMTP password
    $mail->SMTPSecure = 'tls';              // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;         // TCP port to connect to or for ssl 465

    //Recipients
    $mail->setFrom('noreply@Cloud-VAP.com', 'Cloud-VAP');
    $mail->addAddress($email, $name);     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = htmlMailBody($password,$name,$prenomMembre, $email,$row['nomEntreprise'], $link);
    $mail->send();
    return true;
} catch (Exception $e) {
    $this->errorMail[] = "Message could not be sent.<br>Mailer Error: ". $mail->ErrorInfo;
    return false;
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

public function logout()
{
    unset($_SESSION['idMembre']);
    session_destroy();
    echo "Disconnected";
    return true;
}


}

/*$mbre = new MembreAPI();
if ($mbre->doLogin("nouriddinbnz@gmail.com0",1,"74107410")) {
   echo "login done";
} else {
    echo "connection failed, wrong input.<br>";
}

$mbre->logout();*/
//echo "<br>".$_SESSION['nomMembre'];

/*$mbre->sendConfirmationEmail("7410","BEN ZEKRI","Nouriddin", "nouriddin.benzekri@gmail.com",1, "1178692fc49d8631a6aec13891b0522d");*/

/*$az = new DB_API();
$az->dbConnection("vap1_test");*/ 
//$mbre->insertMembre("projet", "ben zekri","nourreddine","nbenz", "azerty","noure@gmail.com","0645342466");
?>