<?php
class Admin {
    private $username;
    private $password;
    private $db;

    public function __construct(){
        //Databasanslutning
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if($this->db->connect_errno > 0){
            die('Fel vid anslutning [' . $this->db->connect_error . ']');
        }
    }

    //Lägg till admin
    /* public function addAdmin($username, $password) {
        //Kryptera lösenord
        $salt = '$2a$07$AHTkw62JnP8g5Wx81IlO3B$';
        $password = crypt($password, $salt);

        $sql = "INSERT INTO admins(username, password) VALUES('" . $username . "', '" . $password . "');";
        return $result = $this->db->query($sql);
    } */

    //Logga in admin
    public function loginAdmin($username, $password) {
        if (!$this->setUsername($username)) {return false; }
        if (!$this->setPassword($password)) {return false; }

        $sql = "SELECT password FROM admins WHERE username='" . $this->username . "';";
        $result = $this->db->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedpassword = $row['password'];

            if($storedpassword == crypt($this->password, $storedpassword)) {
                $_SESSION['username'] = $username;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Kontrollera användarnamn-input
    public function setUsername($username) {
        if ($username != ""){
            $this->username = $this->db->real_escape_string($username);
            $this->username = strip_tags($this->username);
            return true;
        } else {
            return false;
        }
    }

    //Kontrollera lösenord-input
    public function setPassword($password) {
        if ($password != ""){
            $this->password = $this->db->real_escape_string($password);
            $this->password = strip_tags($this->password);
            return true;
        } else {
            return false;
        }
    }
}
?>