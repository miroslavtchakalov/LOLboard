<?php
include ('./FonctionBD.php');
if (isset($_POST['Deconnexion'])) {
    unset($_SESSION['userlogged']);
}
if (isset($_POST['Upload'])) {
    header('Location: ./UploadForm.php');
}

$images = selectIMG();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>The lol Board</title>
        <link rel="stylesheet" href="ImageBoardStyle.css" />
    </head>
    <body>
        <div id="container">
            <header>
                <img src="Images/Logo.PNG" alt="error" id="logo">
                <?php
                if (isset($_SESSION['userlogged'])) {
                    echo'
            <form action="index.php" method="post" id="connexion">
            <p> Bienvenue ' . $_SESSION['userlogged'] . '
                <input type="submit" name="Deconnexion" class="btn" value="Deconnexion">
                <input type="submit" name="Upload" class="btn" value="Publier une image">
            </form>';
                } else {
                    echo'
            <form action="ConnexionInsciption.php" method="get" id="connexion">
                <input type="submit" name="Inscription" class="btn" value="Inscription">
                <input type="submit" name="Connexion" class="btn" value="Connexion">
            </form>';
                }
                ?>
            </header>
            <section>
                <?php
                foreach ($images as $val) {
                    echo'<img src='.$val['url'].' alt="error" class="posts">';
                }
                ?>
            </section>
            <aside></aside>
            <aside></aside>
        </div>
    </body>
</html>

