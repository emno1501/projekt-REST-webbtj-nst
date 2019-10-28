<?php
//Headerinfo: typ: JSON, Tillåt åtkomst för specifik källa, tillåt metoderna GET, POST, PUT & DELETE.
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: http://studenter.miun.se/~emno1501/dt173g/projekt/cv/index.php");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");

include("includes/config.php");

$method = $_SERVER["REQUEST_METHOD"]; //Läsa in HTTP-metod
$request = explode('/', trim($_SERVER['PATH_INFO'],'/')); //Hämta värde som skickats i sökvägen
$input = json_decode(file_get_contents('php://input'),true); //Läsa in data från anrop och konvertera till JSON
$ed = new Education(); //Ny instans av Education-klassen
$workXP = new WorkExperience(); //Ny instans av WorkExperience-klassen
$website = new Website(); //Ny instans av Website-klassen
$response = "";

//Kontrollera första värdet i anropets url för att veta vilken datta som efterfrågas
if($request[0] == "education"){ 
	include("includes/education.php");
} else if($request[0] == "workexperience") {
    include("includes/workexperience.php");
} else if($request[0] == "websites") {
    include("includes/websites.php");
} else {
    http_response_code(404);
    exit();
}

//Konvertera till JSON-format
echo json_encode($response);