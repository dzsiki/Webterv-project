<?php
include_once "common/menu.php";
include_once "users/user.php";
include_once "users/fajlkezeles.php";

if (isset($_SESSION["user"])) header("refresh:0; url=profilom.php");

$errors = [];
$success = false;
if (isset($_POST["send"]))
{
    if (!isset($_POST["name"]) || strlen(trim($_POST["name"])) == 0)
    {
        array_push($errors, ["Felhasználónév megadása kötelező!", 1]);
    } else if (!preg_match("/^[0-9a-zA-Z]+$/", $_POST["name"]))
    {
        array_push($errors, ["A felhasználónév csak az angol abc betűit és számokat tartalmazhat!", 1]);
    }

    if (!isset($_POST["email"]))
    {
        array_push($errors, ["Email megadása kötelező!", 1]);
    } else if (!preg_match("/^[0-9a-z\.-]+@([0-9a-z-]+\.)+[a-z]{2,4}$/", $_POST["email"]))
    {
        array_push($errors, ["Email formátuma hibás!", 1]);
    }

    if (!isset($_POST["pass-1"]) || !isset($_POST["pass-2"]) || strlen(trim($_POST["pass-1"])) == 0 || strlen(trim($_POST["pass-2"])) == 0)
    {
        array_push($errors, ["Jelszó megadása kötelező!", 1]);
    } else if (strcmp($_POST["pass-1"], $_POST["pass-2"]) != 0)
    {
        array_push($errors, ["A jelszavak nem egyeznek!", 1]);
    } else
    {
        $jelszo = $_POST["pass-1"];

        $nagybetu = preg_match('@[A-Z]@', $jelszo);
        $kisbetu = preg_match('@[a-z]@', $jelszo);
        $szam    = preg_match('@[0-9]@', $jelszo);
        $specialis = preg_match('@[^\w]@', $jelszo);

        if(!$nagybetu || !$kisbetu || !$szam || !$specialis || strlen($jelszo) < 8) {
            array_push($errors, ["A jelszó nem elég erős. (Minimum egy nagybetű, kisbetű, szám, spciális karakter kell legyen benne, valamint minium 8 karakter kell legyen.)", 1]);
        }
    }

    if (!isset($_POST["accept"]) || $_POST["accept"] == 0)
    {
        array_push($errors, ["El kell fogadnia az adatkezelési feltételeket!", 1]);
    }

    if (count($errors) == 0)
    {
        $users = Users("users/users.txt");

        $user = new User($_POST["name"], $_POST["email"], $_POST["pass-1"], "");

        $username_used = false;
        foreach ($users as $u)
        {
            if (strcmp($user->getName(), $u->getName()) == 0)
            {
                array_push($errors, ["A felhasználónév már használatban van.", 1]);
                $username_used = true;
                break;
            } else if (strcmp($user->getEmail(), $u->getEmail()) == 0)
            {
                array_push($errors, ["Az email már használatban van.", 1]);
                $username_used = true;
                break;
            }
        }
        
        if ($username_used != true)
        {
            array_push($users, $user);
            Usershozzaad($users, "users/users.txt");
            array_push($errors, ["Sikeres regisztracio!", 0]);
            $success = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
    <link rel="icon" href="img/icon.jpg" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/forms.css" />
    <link rel="stylesheet" href="css/error.css" />
</head>
<body>
<?php include_once "common/header.php";
menu("regisztracio"); ?>
    <main>
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
        
        <h1 class="focim">Belépés</h1>
        <form action="common/login.php" method="POST">
            <label for="login-name">Név: </label><input type="text" name="name" id="login-name" required /><br />

            <label for="login-pass">Jelszó: </label><input type="password" name="pass" id="login-pass" required /><br />
            
            <input type="submit" name="send" id="login-send" value="Belépés" /><br />
        </form>

        <h1 class="focim">Regisztráció</h1>
        <form action="regisztracio.php" method="POST">
            <label for="register-name">Név (csak betűt és számot tartalmazhat): </label><input type="text" name="name" id="register-name" value="<?php if (!$success && isset($_POST["name"])) echo $_POST["name"]; ?>" required /><br />
            
            <label for="register-email">E-mail: </label><input type="email" name="email" id="register-email" placeholder="asd123@example.com" value="<?php if (!$success && isset($_POST["email"])) echo $_POST["email"]; ?>" required /><br />

            <label for="register-pass-1">Jelszó: </label><input type="password" name="pass-1" id="register-pass-1" required /><br />
            <label for="register-pass-2">Jelszó mégegyszer: </label><input type="password" name="pass-2" id="register-pass-2" required /><br />

            <input type="checkbox" name="accept" id="register-accept" <?php if (!$success && isset($_POST["accept"])) echo "checked"; ?> required />
            <label for="register-accept-1">Elfogadom az adatkezelésre vonatkozó feltételeket.</label><br />
            
            <input type="submit" name="send" id="register-send" value="Regisztráció" /><br />
            <input type="reset" value="Alapállapot" />
        </form>
    </main>
    <?php include_once "common/footer.php"; ?>
</body>
</html>
