<?php
/* Funktioner för att hämta/lägga till/uppdatera/ta bort data om Arbetserfarenhet */

/* Switch-sats för HTTP-metoder som anropar metoder i WorkExperience-klassen för att hämta, 
lagra, uppdatera eller ta bort data i databasen */
switch($method) {
    case "GET": //Hämta data
        if(isset($request[1])) { //Kontrollera om värde skickats med i sökvägen
            $id = $request[1];
            if($response = $workXP->getSpecWorkXP($id)) { //Hämta specifik rad i tabellen
                http_response_code(201); //Anrop ok
            } else {
                http_response_code(404); //Fel
                $response = array("message" => "Kunde inte hittas.");
            }
        } else {
            if($response = $workXP->getWorkXP()) { //Hämta all data i tabellen
                http_response_code(201); //Anrop ok
            } else {
                http_response_code(404); //Fel
                $response = array("message" => "Kunde inte hittas.");
            }
        }
        break;
    case "POST": //Lägg till data
        if(isset($_SESSION['username'])) {
            if( isset($input["workTitle"]) && isset($input["workPlace"]) && isset($input["workStart"]) && isset($input["workStop"])) { 
                $workTitle = $input["workTitle"];
                $workPlace = $input["workPlace"];
                $workStart = $input["workStart"];
                $workStop = $input["workStop"];
                //Anropa metod som ställer fråga mot databas samt skicka med värden från anropet mot webbtjänsten
                if($workXP->addWorkXP($workTitle, $workPlace, $workStart, $workStop)) { 
                    http_response_code(201); //Anrop ok
                    $response = array("message" => "Tillagd");
                } else {
                    http_response_code(500); //Serverfel
                    $response = array("message" => "500 Kunde inte läggas till.");
                }
            } else {
                http_response_code(404); //Fel
                $response = array("message" => "404 Kunde inte läggas till.");
            }
        } else {
            http_response_code(404); //Fel
            $response = array("message" => "404 Inloggning krävs.");
        }
        break;
    case "PUT": //Uppdatera data
        if(isset($_SESSION['username'])) {
            if(isset($input["workTitle"]) && isset($input["workPlace"]) && isset($input["workStart"]) && isset($input["workStop"]) && isset($request[1])) {
                $id = $request[1];
                $workTitle = $input["workTitle"];
                $workPlace = $input["workPlace"];
                $workStart = $input["workStart"];
                $workStop = $input["workStop"];
                //Anropa metod som ställer fråga mot databas och skickar med värden och id till rad som ska uppdateras
                if($workXP->updateWorkXP($id, $workTitle, $workPlace, $workStart, $workStop)) {
                    http_response_code(201); //Anrop ok
                    $response = array("message" => "Uppdaterad");
                } else {
                    http_response_code(500); //Serverfel
                    $response = array("message" => "500 Kunde inte uppdateras.");
                }
            } else {
                http_response_code(404); //Fel
                $response = array("message" => "404 Kunde inte uppdateras.");
            }
        } else {
            http_response_code(404); //Fel
            $response = array("message" => "404 Inloggning krävs.");
        }
        break;
    case "DELETE": //Ta bort data
        if(isset($_SESSION['username'])) {
            if(isset($request[1])) {
                $id = $request[1];
                //Anropa metod som ställer fårga mot databasen att ta bort specifik rad
                if($workXP->deleteWorkXP($id)) {
                    http_response_code(201); //Anrop ok
                    $response = array("message" => "Borttagen");
                } else {
                    http_response_code(500); //Serverfel
                    $response = array("message" => "Kunde inte raderas");
                }
            } else {
                http_response_code(404); //Fel
                $response = array("message" => "Kunde inte tas bort.");
            }
        } else {
            http_response_code(404); //Fel
            $response = array("message" => "404 Inloggning krävs.");
        }
        break;
}