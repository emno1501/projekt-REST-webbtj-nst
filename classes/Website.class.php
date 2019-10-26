<?php
class Website {
    private $websiteTitle;
    private $websiteDescr;
    private $websiteLink;
    private $db;

    public function __construct(){
        //Databasanslutning
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if($this->db->connect_errno > 0){
            die('Fel vid anslutning [' . $this->db->connect_error . ']');
        }
    }
    //Hämta alla utbildningar
    public function getWebsites() {
        $sql = "SELECT * FROM websites ORDER BY websiteID DESC;";
        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    //Hämta specifik utbildning
    public function getSpecWebsite($id) {
        $id = intval($id);
        $sql = "SELECT * FROM websites WHERE websiteID=$id;";
        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    //Lägg till utbildning
    public function addWebsite($websiteTitle, $websiteDescr, $websiteLink) {
        if (!$this->setWebTitle($websiteTitle)) {return false; }
        if (!$this->setWebDescr($websiteDescr)) {return false; }
        if (!$this->setWebLink($websiteLink)) {return false; }
        $sql = "INSERT INTO websites(websiteTitle, websiteDescription, websiteLink) VALUES('" . $this->websiteTitle . "', '" . $this->websiteDescr . "', '" . $this->websiteLink . "');";
        return $result = $this->db->query($sql);
    }
    //Uppdatera utbildning
    public function updateWebsite($id, $websiteTitle, $websiteDescr, $websiteLink) {
        if (!$this->setWebTitle($websiteTitle)) {return false; }
        if (!$this->setWebDescr($websiteDescr)) {return false; }
        if (!$this->setWebLink($websiteLink)) {return false; }
        $id = intval($id);
        $sql = "UPDATE websites SET websiteTitle='" . $this->websiteTitle . "', websiteDescription='" . $this->websiteDescr . "', websiteLink='" . $this->websiteLink . "' WHERE websiteID=$id;";
        return $result = $this->db->query($sql);
    }
    //Radera utbildning
    public function deleteWebsite($id) {
        $id = intval($id);
        $sql = "DELETE FROM websites WHERE websiteID=$id;";
        return $result = $this->db->query($sql);
    }
    //Kontrollera edName-input
    public function setWebTitle($websiteTitle) {
        if ($websiteTitle != ""){
            $this->websiteTitle = mysqli_real_escape_string($this->db, $websiteTitle);
            $this->websiteTitle = strip_tags($this->websiteTitle);
            return true;
        } else {
            return false;
        }
    }
    //Kontrollera edPlace-input
    public function setWebDescr($websiteDescr) {
        if ($websiteDescr != ""){
            $this->websiteDescr = mysqli_real_escape_string($this->db, $websiteDescr);
            $this->websiteDescr = strip_tags($this->websiteDescr);
            return true;
        } else {
            return false;
        }
    }
    //Kontrollera edDates-input
    public function setWebLink($websiteLink) {
        if ($websiteLink != ""){
            $this->websiteLink = mysqli_real_escape_string($this->db, $websiteLink);
            $this->websiteLink = strip_tags($this->websiteLink);
            return true;
        } else {
            return false;
        }
    }
}
?>