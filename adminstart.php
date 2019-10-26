<?php
include("includes/config.php");

//Kontroll att användarnamn finns lagrat i sessionen
if (!isset($_SESSION['username'])) {
    header("location: admin.php");
}
//Ta bort session vid utlogg
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();

    header("location:admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="sv-SE">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="pub/css/main.css" />
    </head>
    <body>
    <a href="adminstart.php?logout=1" id="logoutBtn">Logga ut</a> <!-- Logga ut-knapp -->
    <!-- Huvudmeny -->
    <nav>
        <ul>
            <li id="edTab" class="current">Utbildning</li>
            <li id="workTab" class="hidden">Arbetserfarenhet</li>
            <li id="webTab" class="hidden">Webbsidor</li>
        </ul>
    </nav>
    <?php
    //Inkludera filer med admingränssnittets sektioner
        include("includes/admineducation.php");
        include("includes/adminwork.php");
        include("includes/adminwebsites.php");
    ?>
    <script src="pub/js/main.js"></script>
    </body>
</html>