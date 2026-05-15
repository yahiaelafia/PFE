<?php
class database {
private $host = 'localhost';
private $dbname = 'ataa';
private $username = 'root';
private $password = 'yahia123';
private $conn ;
public function getconnection() {
    $this->conn = null ;
try {
    $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur en Connexion: " . $e->getMessage());
}
return $this->conn ;
}
}
?>