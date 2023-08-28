<?php
  include_once "../users/user.php";
  include_once "../users/fajlkezeles.php";
  include_once "msg_page_generator.php";
  
  session_start();
  
  $fiokok = Users("../users/users.txt");

  $uzenet = "";

  if (isset($_POST["send"])) {
    if (!isset($_POST["name"]) || trim($_POST["name"]) === "" || !isset($_POST["pass"]) || trim($_POST["pass"]) === "") {
      $uzenet = "<strong>Hiba:</strong> Adj meg minden adatot!" . $_POST["name"] . " " . $_POST["pass"];
    } else {
      $name = $_POST["name"];
      $pass = $_POST["pass"];

      $uzenet = "Sikertelen belépés! A belépési adatok nem megfelelők!";

      foreach ($fiokok as $fiok) {
        if ($fiok->getName() === $name && $fiok->getPass() === $pass) {
          $_SESSION["user"] = $fiok;
          $uzenet = "Sikeres belépés! Nemsokára átirányítjuk.";
          break; 
        }
      }
    }
  }

  genMsgPage("Bejelentkezés", $uzenet);
  header("refresh:2; url=../regisztracio.php");
?>