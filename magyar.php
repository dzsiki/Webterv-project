<?php
include_once "common/menu.php";
include_once "common/meme.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Magyar Mémek</title>
    <link rel="icon" href="img/icon.jpg"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/meme.css">
</head>
<body>
<?php include_once "common/header.php";
menu("magyar"); ?>
    <main>
        <article class="meme-upload">
            <form action="upload.php" method="GET">
                <input type="hidden" name="type" value="hun">
                <input type="submit" name="upload-btn" value="Meme feltöltés">
            </form>
        </article>


        <section id="magyar-memek">
        <?php
        renderMemes(MemeType::Magyar);
        ?>
        </section>
    </main>
    <?php include_once "common/footer.php"; ?>
</body>
</html>
