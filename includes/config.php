<?php
// Aktivera felrapportering
error_reporting(-1);
ini_set("display_errors", 1);

//Inkludera klass-filer
spl_autoload_register(function ($class) {
    include "classes/" . $class . ".class.php";
});

//Värden för databasanslutning
/* define("DBHOST", "localhost");
define("DBUSER", "emma2");
define("DBPASS", "password");
define("DBDATABASE", "cv_rest"); */
define("DBHOST", "studentmysql.miun.se");
define("DBUSER", "emno1501");
define("DBPASS", "7sr8zjuo");
define("DBDATABASE", "emno1501");

//Starta session
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}