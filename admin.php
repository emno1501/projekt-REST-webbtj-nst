<?php
include("includes/config.php");

$admin = new Admin();

//Kod för att lägga till admin
/* if($admin->addAdmin("användarnamn", "lösenord")) {
    echo "Admin tillagd";
} else {
    echo "Admin ej tillagd";
} */

//Logga in
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($admin->loginAdmin($username, $password)) {
        header("location: adminstart.php");
    } else {
        $message = "<p class='formmsg'>Användarnamn eller lösenord felaktigt</p>";
    }
}

?>
<!-- Inloggningssida till admingränssnitt -->
<!DOCTYPE html>
<html lang="sv-SE">
    <head>
        <meta charset="utf-8" />
        <title>Administrationsgränssnitt CV-webbtjänst</title>
    </head>
    <body>
        <form method="post" action="admin.php">
            <label>Användarnamn<input type="text" name="username" /></label>
            <label>Lösenord<input type="password" name="password" /></label>
            <input type="submit" value="Logga in" name="login" />
        </form>
    </body>
</html>