
<?php

//Informations relatives à la BD
define("HOST", "127.0.0.1");
define("DBNAME", "imageboarddb");
define("USER", "miroslav");
define("PASS", "Super");

//Nom des tables !!A CHANGER!!
define("TABLENAME", "utilisateurs");
define("TABLENAME2", "images");

//Noms des champs !!A CHANGER!!
define("IDUSER", "idUtilisateur");
define("USERNAME", "nomUtilisateur");
define("EMAIL", "email");
define("BIRTHDATE", "dateNaissance");
define("PASSWORD", "motDePass");
define("URL", "url");

//Noms des DossiersImages !!A CHANGER!!


session_start();

function GetConnexion() {
    static $dbh = NULL;
    if ($dbh === NULL) {
        try {
            $dbh = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASS);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    return $dbh;
}

function InsertionImg($url) {

    $db = GetConnexion();
    $req = $db->prepare('INSERT INTO ' . TABLENAME2 . '(' . URL .') VALUES(:url)');

    $req->bindParam(':url', $url, PDO::PARAM_STR);

    $retour = $req->execute();
}


function Insertion($username, $email, $birthDate, $pass) {

    $db = GetConnexion();
    $pass = sha1($pass);
    $req = $db->prepare('INSERT INTO ' . TABLENAME . '(' . USERNAME . ',' . EMAIL . ',' . BIRTHDATE . ',' . PASSWORD . ') VALUES(:Nickname,:Email,:BirthDate, :Password)');

    $req->bindParam(':Nickname', $username, PDO::PARAM_STR);
    $req->bindParam(':Email', $email, PDO::PARAM_STR);
    $req->bindParam(':BirthDate', $birthDate, PDO::PARAM_STR);
    $req->bindParam(':Password', $pass, PDO::PARAM_STR);
    $retour = $req->execute();
}

function SelectIMG() {
    $db = GetConnexion();
    $req = $db->prepare('SELECT ' . URL . ' FROM ' . TABLENAME2);
    $req->execute();
    $requestResponse = $req->fetchAll();
    return $requestResponse;
}

function SelectUser($id) {
    echo $id;
    $db = GetConnexion();
    $req = $db->prepare("SELECT * FROM " . TABLENAME . " WHERE " . IDUSER . "='" . $id . "'");
    $req->execute();
    $requestResponse = $req->fetch();
    return $requestResponse;
}

function AssocToHtml($listUsers) {
    foreach ($listUsers as $val) {
        echo '<tr><td>' . $val['prenom'] . ' </td><td> ' . $val['nom'] . '</td><td> <a href="Userdetail.php?id=' . $val['idUser'] . '"> <= voir les details</a></td></tr>';
    }
}

function DetailsToHtml($UserInfo) {
    echo '<tr><td>' . $UserInfo['prenom'] . ' </td><td> ' . $UserInfo['nom'] . '</td><td>' . $UserInfo['dateNaissance'] . '</td><td>' . $UserInfo['pseudo'] . '</td><td>' . $UserInfo['email'] . '</td><td>' . $UserInfo['description'] . '</td></td></tr>';
}

function deleteUser($id) {
    $id = $_REQUEST['idUser'];
    $db = GetConnexion();
    $req = $db->prepare("DELETE FROM " . TABLENAME . " WHERE " . IDUSER . "= '$id'");
    $req->execute();
}

function login($username, $pass) {
    $pass = sha1($pass);
    $db = GetConnexion();
    $req = $db->prepare('SELECT ' . USERNAME . ',' . PASSWORD . ' FROM ' . TABLENAME . ' WHERE ' . USERNAME . '=:user AND ' . PASSWORD . '=:password');
    $req->bindParam(':user', $username, PDO::PARAM_STR);
    $req->bindParam(':password', $pass, PDO::PARAM_STR);
    $req->execute();
    $result = $req->fetch(PDO::FETCH_ASSOC);
    if ($result == false) {
        return false;
    } else {

        $_SESSION['userlogged'] = $result['nomUtilisateur'];
        return true;
    }
}