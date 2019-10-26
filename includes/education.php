<?php
/* Funktioner för att hämta/lägga till/uppdatera/ta bort data om Utbildning */

/* Switch-sats för HTTP-metoder som anropar metoder i Education-klassen för att hämta, 
lagra, uppdatera eller ta bort data i databasen */
switch($method) {
    case "GET": //Hämta data
        if(isset($request[1])) { //Kontrollera om värde skickats med i sökvägen
            $id = $request[1];
            if($response = $ed->getSpecEducation($id)) { //Hämta specifik rad i tabellen
                http_response_code(201); //Anrop ok
            } else {
                http_response_code(404); //Fel
                $response = array("message" => "Kunde inte hittas.");
            }
        } else {
            if($response = $ed->getEducations()) { //Hämta all data i tabellen
                http_response_code(201); //Anrop ok
            } else {
                http_response_code(404); //Fel
                $response = array("message" => "Kunde inte hittas.");
            }
        }
        break;
    case "POST": //Lägg till data
        if(isset($_SESSION['username'])) {
            if( isset($input["edName"]) && isset($input["edPlace"]) && isset($input["edStart"]) && isset($input["edStop"])) { 
                $edName = $input["edName"];
                $edPlace = $input["edPlace"];
                $edStart = $input["edStart"];
                $edStop = $input["edStop"];
                //Anropa metod som ställer fråga mot databas samt skicka med värden från anropet mot webbtjänsten
                if($ed->addEducation($edName, $edPlace, $edStart, $edStop)) {
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
            if(isset($input["edName"]) && isset($input["edPlace"]) && isset($input["edStart"]) && isset($input["edStop"]) && isset($request[1])) {
                $id = $request[1];
                $edName = $input["edName"];
                $edPlace = $input["edPlace"];
                $edStart = $input["edStart"];
                $edStop = $input["edStop"];
                //Anropa metod som ställer fråga mot databas och skickar med värden och id till rad som ska uppdateras
                if($ed->updateEducation($id, $edName, $edPlace, $edStart, $edStop)) {
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
                if($ed->deleteEducation($id)) {
                    http_response_code(201); //Anrop ok
                    $response = array("message" => "Borttagen");
                } else {
                    http_response_code(500); //Serverfel
                    $response = array("message" => "Kunde inte tas bort");
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