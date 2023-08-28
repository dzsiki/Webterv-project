<?php
include_once "common/menu.php";
include_once "users/user.php";
include_once "common/msg_page_generator.php";

if (isset($_SESSION["user"]))
{
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>
    <?php
    echo $_SESSION["user"]->getName();
    ?>
    </title>
    <link rel="icon" href="img/icon.jpg"/>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .blur {
            cursor: pointer;
        }
        .blur > span {
            filter: blur(20px);
            transition: filter 0.5s;
        }
        .blur:active > span {
            filter: blur(0px);
        }
        main {
            text-align: center;
        }
        input {
            font-size: 23px;
            margin-top: 10px;
        }
        #logout-btn {
            color: red;
        }
    </style>
</head>
<body>
<?php include_once "common/header.php"; 
menu("regisztracio"); ?>
    <main style="width: 65%;">
    
    <h1 class="focim">Felhasználónév: <?php echo $_SESSION["user"]->getName(); ?></h1>
    <h1 class="focim">E-mail: <?php echo $_SESSION["user"]->getEmail(); ?></h1>
    <h1 class="focim blur">Jelszó: <span><?php echo $_SESSION["user"]->getPass(); ?></span> 👁</h1>

<?php
if ($_SESSION["user"]->getType() === UserType::Admin)
{
?>
    <form action="adminisztracio.php" method="GET">
        <input type="submit" value="Adminisztrációs eszközök" /><br />
    </form>
<?php
}
?>

    <form action="upload.php" method="GET">
        <input type="submit" value="Feltöltés" /><br />
    </form>

    <form action="common/logout.php" method="GET">
        <input id="logout-btn" type="submit" value="Kijelentkezés" /><br />
    </form>


    </main>
    <?php include_once "common/footer.php"; ?>
</body>
</html>

<?php
} else
{
    genMsgPage("Hiba", "Jelentkezz be a profilhoz!");
    header( "refresh:2; url=regisztracio.php" );
}
?>
