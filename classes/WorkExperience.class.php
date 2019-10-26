<?php
class WorkExperience {
    private $workTitle;
    private $workPlace;
    private $workStart;
    private $workStop;
    private $db;

    public function __construct(){
        //Databasanslutning
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if($this->db->connect_errno > 0){
            die('Fel vid anslutning [' . $this->db->connect_error . ']');
        }
    }
    //Hämta alla utbildningar
    public function getWorkXP() {
        $sql = "SELECT * FROM workExperience ORDER BY workID DESC;";
        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    //Hämta specifik utbildning
    public function getSpecWorkXP($id) {
        $id = intval($id);
        $sql = "SELECT * FROM workExperience WHERE workID=$id;";
        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    //Lägg till utbildning
    public function addWorkXP($workTitle, $workPlace, $workStart, $workStop) {
        if (!$this->setWorkTitle($workTitle)) {return false; }
        if (!$this->setWorkPlace($workPlace)) {return false; }
        if (!$this->setWorkStart($workStart)) {return false; }
        if (!$this->setWorkStop($workStop)) {return false; }
        $sql = "INSERT INTO workExperience(workTitle, workPlace, workStart, workStop) VALUES('" . $this->workTitle . "', '" . $this->workPlace . "', '" . $this->workStart . "', '" . $this->workStop . "');";
        return $result = $this->db->query($sql);
    }
    //Uppdatera utbildning
    public function updateWorkXP($id, $workTitle, $workPlace, $workStart, $workStop) {
        if (!$this->setWorkTitle($workTitle)) {return false; }
        if (!$this->setWorkPlace($workPlace)) {return false; }
        if (!$this->setWorkStart($workStart)) {return false; }
        if (!$this->setWorkStop($workStop)) {return false; }
        $id = intval($id);
        $sql = "UPDATE workExperience SET workTitle='" . $this->workTitle . "', workPlace='" . $this->workPlace . "', workStart='" . $this->workStart . "', workStop='" . $this->workStop . "' WHERE workID=$id;";
        return $result = $this->db->query($sql);
    }
    //Radera utbildning
    public function deleteWorkXP($id) {
        $id = intval($id);
        $sql = "DELETE FROM workExperience WHERE workID=$id;";
        return $result = $this->db->query($sql);
    }
    //Kontrollera edName-input
    public function setWorkTitle($workTitle) {
        if ($workTitle != ""){
            $this->workTitle = mysqli_real_escape_string($this->db, $workTitle);
            $this->workTitle = strip_tags($this->workTitle);
            return true;
        } else {
            return false;
        }
    }
    //Kontrollera edPlace-input
    public function setWorkPlace($workPlace) {
        if ($workPlace != ""){
            $this->workPlace = mysqli_real_escape_string($this->db, $workPlace);
            $this->workPlace = strip_tags($this->workPlace);
            return true;
        } else {
            return false;
        }
    }
    //Kontrollera edStart-input
    public function setWorkStart($workStart) {
        if ($workStart != ""){
            $this->workStart = mysqli_real_escape_string($this->db, $workStart);
            $this->workStart = strip_tags($this->workStart);
            return true;
        } else {
            return false;
        }
    }
    //Kontrollera edStop-input
    public function setWorkStop($workStop) {
        if ($workStop != ""){
            $this->workStop = mysqli_real_escape_string($this->db, $workStop);
            $this->workStop = strip_tags($this->workStop);
            return true;
        } else {
            return false;
        }
    }
}
?>