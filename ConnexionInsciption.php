<?php
include ('./FonctionBD.php');

if (isset($_POST["Valider"]) && $_POST["MotDePasse"] == $_POST["Confirmation"]) {
    Insertion($_POST["NomUtilisateur"], $_POST["Email"], $_POST["DateNaissance"], $_POST["MotDePasse"]);
    header('Location: ./Index.php');
    echo 'Connexion reussi';
} else if (isset($_POST["MotDePasse"]) != isset($_POST["Confirmation"])) {
    header('Location: ./ConnexionInsciption.php?Inscription=Inscription');
}

if(isset($_POST["ValiderCon"]))
{
    if (login($_POST["loginNom"], $_POST["loginPass"])) {
         header('Location: ./Index.php');
         var_dump($_SESSION["userlogged"]);
    } 
    else
    {
        header('Location: ./ConnexionInsciption.php?Connexion=Connexion');
    }
 
}
?>
<!DOCTYPE html>
<html>
<head>
<title>The lol Board</title>
<link rel="stylesheet" href="ImageBoardStyle.css" />
</head>
<body>
    <div id="container">
        
        <?php
        if (isset($_GET['Inscription']) == "Inscription") {
            echo'<section style="width: 40%;margin: auto;float:none;margin-top:70px;">
                <form action="ConnexionInsciption.php" method="post">
                    <table id="tableInscription">
                        <tr><td>Nom d\'utilisateur : </td> <td><input type="text" name="NomUtilisateur"></td></tr>
                        <tr><td>mail : </td> <td><input type="email" name="Email"></td></tr>
                        <tr><td>Date de naissance : </td> <td><input type="date" name="DateNaissance"></td></tr>
                        <tr><td>Mot de passe : </td> <td><input type="password" name="MotDePasse"></td></tr>
                        <tr><td>Confirmation : </td> <td><input type="password" name="Confirmation"></td></tr>
                        <tr><td><input type="submit" name="Valider" value="Validation" class="btn"></td><td><input type="Button" name="Effacer" value="Effacer" class="btn"></td></tr>
                    </table>
                </form>
            </section>';
        }
        else
        {
             echo'<section style="width: 40%;margin: auto;float:none;margin-top:70px;">
                <form action="ConnexionInsciption.php" method="post">
                    <table id="tableInscription">
                        <tr><td>Nom d\'utilisateur : </td> <td><input type="text" name="loginNom"></td></tr>
                        <tr><td>Mot de passe : </td> <td><input type="password" name="loginPass"></td></tr>
                        <tr><td><input type="submit" name="ValiderCon" value="Validation" class="btn"></td><td><input type="Button" name="Effacer" value="Effacer" class="btn"></td></tr>
                    </table>
                </form>
            </section>';
        }
        ?>
    </div>
</body>
</html>


