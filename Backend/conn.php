<?php
class dbConnect{
    private $conn =null;
    private $servername = "localhost:3307"; 
    private $dbname = "glam_db"; 
    private $username = "root"; 
    private $password = ""; 

    public function connectDB(){
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", 
            $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) . "<br/>";
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC) . "<br/>";
    
        } catch (PDOException $pdoe) {
            die("Nuk mund të lidhej me bazën e të dhënave {$this->dbname} :" . $pdoe->getMessage());
        }
        return $this->conn;
    }

    protected static function getConn()
{
    return $conn;
}

}

?>

