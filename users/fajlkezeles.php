<?php

  function Users($file_nev) {
    $users = [];                  

    $file = fopen($file_nev, "r");   

    while (($sor = fgets($file)) !== FALSE) { 
      $user = unserialize($sor);  
      $users[] = $user;            
    }

    fclose($file);
    return $users;               
  }

  function Usershozzaad($users, $file_nev) {
    $file = fopen($file_nev, "w");   

    foreach($users as $user) {   
      $serialized_user = serialize($user);     
      fwrite($file, $serialized_user . "\n");  
    }

    fclose($file);
  }
?>