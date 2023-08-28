<?php
include_once "common/menu.php";
include_once "users/user.php";
include_once "users/fajlkezeles.php";
include_once "common/msg_page_generator.php";

if (isset($_SESSION["user"]))
{
    if ($_SESSION["user"]->getType() === UserType::Admin)
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
    </style>
</head>
<body>
<?php include_once "common/header.php"; 
menu("regisztracio"); ?>
    <main style="width: 65%;">
    
    <h1 class="focim">Adminisztrációs eszközök</h1>

    <h1 class="focim">Felhasználók listája</h1>
    <table>
    <thead>
    <tr>
        <th>Felhasználónév</th>
        <th>E-mail</th>
        <th>Fiók típus</th>
    </tr>
    </thead>
    <?php
    $users = Users("users/users.txt");

    if (isset($_POST["give-admin"]) && isset($_POST["user"]))
    {
        $success = false;
        foreach ($users as $u)
        {
            if ($u->getName() === $_POST["user"])
            {
                $success = true;
                $u->setType(UserType::Admin);
                Usershozzaad($users, "users/users.txt");
                echo "<strong>" . $_POST["user"] . " felhasználó admin jogot kapott.</strong>";
                break;
            }
        }
        if (!$success) echo "<strong>Nem sikerült a művelet!</strong>";
    } else if (isset($_POST["take-admin"]) && isset($_POST["user"]))
    {
        $success = false;
        foreach ($users as $u)
        {
            if ($u->getName() === $_POST["user"])
            {
                $success = true;
                $u->setType(UserType::Normal);
                Usershozzaad($users, "users/users.txt");
                echo "<strong>" . $_POST["user"] . " felhasználó admin joga megvonva.</strong>";
                break;
            }
        }
        if (!$success) echo "<strong>Nem sikerült a művelet!</strong>";
    }

    foreach ($users as $u)
    {
    ?>
        <tr>
            <td><?php echo $u->getName(); ?></td>
            <td><?php echo $u->getEmail(); ?></td>
            <td><?php echo UserType::toString($u->getType()); ?></td>
            <?php
            if ($u->getName() !== $_SESSION["user"]->getName())
            {
            ?>
                <td>
                    <form method="POST">
                        <input type="hidden" name="user" value="<?php echo $u->getName(); ?>">
                        <input type="submit" name="give-admin" value="Admin jog adása">
                    </form>
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="user" value="<?php echo $u->getName(); ?>">
                        <input type="submit" name="take-admin" value="Admin jog megvonása">
                    </form>
                </td>
            <?php
            } else
            {
            ?>
                <td colspan="2">
                    A saját jogosultságaidat nem változtathatod!
                </td>
            <?php
            }
            ?>
        </tr>
    <?php
    }
    ?>
    </table>

    </main>
    <?php include_once "common/footer.php"; ?>
</body>
</html>

<?php
    } else
    {
        genMsgPage("Hiba", "Nem vagy admin!");
        header( "refresh:2; url=profilom.php" );
    }
} else
{
    genMsgPage("Hiba", "Jelentkezz be!");
    header( "refresh:2; url=regisztracio.php" );
}
?>
