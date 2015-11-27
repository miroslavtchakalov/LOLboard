<?php


    /**
     * Conversion taille de fichier
     * @param type $size
     * @return type
     */
    function format_size($size) {
      $label = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
      for ($i = 0; $size >= 1024 && $i < ( count($label) - 1 ); $size /= 1024, $i++)
        ;
      return( round($size, 2) . " " . $label[$i] );
    }


  function uploadAvatar(){
    // Chemin destination (r�pertoire courant + /upload/)
    $uploaddir = /*realpath('.') .*/ '../ImageBoard/Posts/';
    foreach ($_FILES['avatar']['name'] as $key => $file) {
        format_size($_FILES['avatar']['size'][$key]);
        $ext = pathinfo($_FILES['avatar']['name'][$key], PATHINFO_EXTENSION);
        $destination_filename = uniqid('Post_', true) . '.' . $ext;
      // Copie depuis le r�pertoire temporaire
      $copie = move_uploaded_file($_FILES['avatar']['tmp_name'][$key], $uploaddir . $destination_filename);
    }
    return $uploaddir.$destination_filename;
  }

    /*if (isset($_FILES) && is_array($_FILES)) {
      uploadAvatar();
    }*/
