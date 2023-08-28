<?php
include_once "common/menu.php";
include_once "users/user.php";
include_once "users/fajlkezeles.php";
include_once "common/meme.php";

if (!isset($_SESSION["user"])) header("refresh:0; url=regisztracio.php");

$errors = [];
if (isset($_POST["upload-btn"]))
{
    if (!isset($_POST["name"]) || strlen(trim($_POST["name"])) == 0)
    {
        array_push($errors, ["A meme nevének megadása kötelező!", 1]);
    }

    if (!isset($_POST["kat"]))
    {
        array_push($errors, ["A kategória beállítása kötelező!", 1]);
    }

    if (!isset($_FILES["meme-pic"]))
    {
        array_push($errors, ["Fájlt fel kell tölteni!", 1]);
    }
    

    if (count($errors) == 0)
    {
     if(str_starts_with($_FILES["meme-pic"]["type"],"image")) {
          $filename = $_FILES["meme-pic"]["name"];
          $tempfile = $_FILES["meme-pic"]["tmp_name"];
          $cel_utvonal = "uploadimg/" . uniqid() . $_FILES["meme-pic"]["name"];
          $feltolto= $_SESSION["user"]->getName();

          move_uploaded_file($_FILES["meme-pic"]["tmp_name"], $cel_utvonal);

          $meme = NULL;
          if ($_POST["kat"] === "egyetem") $meme = new Meme($_POST["name"],$feltolto,$cel_utvonal,MemeType::Egyetem);
          else $meme = new Meme($_POST["name"],$feltolto,$cel_utvonal,MemeType::Magyar);
          
          $memes = Memes("common/memek.txt");
          array_unshift($memes,$meme);
          Memehozzaad($memes,"common/memek.txt");

          array_push($errors, ["Sikeres feltöltés!", 0]);
     } else {
     array_push($errors, ["Képet tölts fel!", 1]);
     }
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Feltöltés</title>
    <link rel="icon" href="img/icon.jpg"/>
    <link rel="stylesheet" href="css/forms.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/error.css" />
</head>
<body>
<?php include_once "common/header.php";
menu(""); ?>
    <main style="width: 65%;">
    <?php
    foreach ($errors as $error)
    {
        if ($error[1] == 1)
        {
            echo "<div class='error-msg'>$error[0]</div><br>";
        } else
        {
            echo "<div class='success-msg'>$error[0]</div><br>";
        }
    }
    ?>
    
    <h1 class="focim">Meme feltöltés</h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="upload-name">Meme neve: </label><input type="text" name="name" id="upload-name" required /><br />
            
            Kategória:
            <label for="upload-kat-op2">Magyar</label>
            <input type="radio" name="kat" id="upload-kat-op2" value="magyar" <?php if(isset($_GET["type"]) && $_GET["type"] === "hun") echo "checked"; ?> />
            <label for="upload-kat-op1">Egyetem</label>
            <input type="radio" name="kat" id="upload-kat-op1" value="egyetem" <?php if(!isset($_GET["type"]) || $_GET["type"] !== "hun") echo "checked"; ?> /><br /><br />
           

            <label for="file-upload">Fájl:</label><br />
            <input type="file" id="file-upload" name="meme-pic" required /> <br/>

            <input type="submit" name="upload-btn" value="Feltöltés"/>
            <input type="reset" value="Alapállapot" />
        </form>

    </main>
    <?php include_once "common/footer.php"; ?>
</body>
</html>