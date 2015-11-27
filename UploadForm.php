<?php
include './FonctionBD.php';
include 'upload.php';

if (isset($_POST['Valider'])) {
   //Renomer avatar en image
    InsertionImg(uploadAvatar());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>HTML5 : File API (Upload)</title>
        <link rel="stylesheet" href="ImageBoardStyle.css" type="text/css">
    </head>
    <body>   
        <div id="container">

            <form  method="post" action="UploadForm.php" enctype="multipart/form-data">
                <input type="file" multiple name="avatar[]" id="mesfichiers">        
                <input type="submit" name="Valider" value="Envoyer">  
            </form>
        </div>
    </body>
</html>
