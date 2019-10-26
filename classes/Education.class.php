<?php
class Education {
    private $edName;
    private $edPlace;
    private $edStart;
    private $edStop;
    private $db;

    public function __construct(){
        //Databasanslutning
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if($this->db->connect_errno > 0){
            die('Fel vid anslutning [' . $this->db->connect_error . ']');
        }
    }
    //Hämta alla utbildningar
    public function getEducations() {
        $sql = "SELECT * FROM educations ORDER BY edID DESC;";
        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    //Hämta specifik utbildning
    public function getSpecEducation($id) {
        $id = intval($id);
        $sql = "SELECT * FROM educations WHERE edID=$id;";
        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    //Lägg till utbildning
    public function addEducation($edName, $edPlace, $edStart, $edStop) {
        if (!$this->setEdName($edName)) {return false; }
        if (!$this->setEdPlace($edPlace)) {return false; }
        if (!$this->setEdStart($edStart)) {return false; }
        if (!$this->setEdStop($edStop)) {return false; }
        $sql = "INSERT INTO educations(edName, edPlace, edStart, edStop) VALUES('" . $this->edName . "', '" . $this->edPlace . "', '" . $this->edStart . "', '" . $this->edStop . "');";
        return $result = $this->db->query($sql);
    }
    //Uppdatera utbildning
    public function updateEducation($id, $edName, $edPlace, $edStart, $edStop) {
        if (!$this->setEdName($edName)) {return false; }
        if (!$this->setEdPlace($edPlace)) {return false; }
        if (!$this->setEdStart($edStart)) {return false; }
        if (!$this->setEdStop($edStop)) {return false; }
        $id = intval($id);
        $sql = "UPDATE educations SET edName='" . $this->edName . "', edPlace='" . $this->edPlace . "', edStart='" . $this->edStart . "', edStop='" . $this->edStop . "' WHERE edID=$id;";
        return $result = $this->db->query($sql);
    }
    //Radera utbildning
    public function deleteEducation($id) {
        $id = intval($id);
        $sql = "DELETE FROM educations WHERE edID=$id;";
        return $result = $this->db->query($sql);
    }
    //Kontrollera edName-input
    public function setEdName($edName) {
        if ($edName != ""){
            $this->edName = mysqli_real_escape_string($this->db, $edName);
            $this->edName = strip_tags($this->edName);
            return true;
        } else {
            return false;
        }
    }
    //Kontrollera edPlace-input
    public function setEdPlace($edPlace) {
        if ($edPlace != ""){
            $this->edPlace = mysqli_real_escape_string($this->db, $edPlace);
            $this->edPlace = strip_tags($this->edPlace);
            return true;
        } else {
            return false;
        }
    }
    //Kontrollera edStart-input
    public function setEdStart($edStart) {
        if ($edStart != ""){
            $this->edStart = mysqli_real_escape_string($this->db, $edStart);
            $this->edStart = strip_tags($this->edStart);
            return true;
        } else {
            return false;
        }
    }
    //Kontrollera edStop-input
    public function setEdStop($edStop) {
        if ($edStop != ""){
            $this->edStop = mysqli_real_escape_string($this->db, $edStop);
            $this->edStop = strip_tags($this->edStop);
            return true;
        } else {
            return false;
        }
    }
}
?>