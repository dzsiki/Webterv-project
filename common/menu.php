
<?php
include_once "users/user.php";

session_start();

function menu($curr) {
   echo "
       <nav id=\"menu\"><ul><li class=\"menufulek\" id=\"logo\"><img src=\"img/logo.png\" alt=\"Logo\" title=\"A Logonk\"/></li>
       <li class=\"menufulek" . ($curr==="index" ? " curr": "") . "\"><a href=\"index.php\">Főoldal</a></li>
       <li class=\"menufulek" . ($curr==="rolunk" ? " curr": "") . "\"><a href=\"rolunk.php\">Rólunk</a></li>
       <li class=\"menufulek" . ($curr==="magyar" ? " curr": "") ."\"><a href=\"magyar.php\">Magyar Mémek</a></li>
       <li class=\"menufulek" . ($curr==="egyetem" ? " curr": "") . "\"><a href=\"egyetem.php\">Egyetem Mémek</a></li>
       <li class=\"menufulek" . ($curr==="regisztracio" ? " curr": "") ."\"><a href=\"" . (isset($_SESSION["user"]) ? "profilom.php" : "regisztracio.php") . "\">" . (isset($_SESSION["user"]) ? $_SESSION["user"]->getName() : "Regisztráció/Bejelentkezés") . "</a></li></ul></nav>";}
?>