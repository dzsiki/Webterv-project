<?php
function genMsgPage(string $title, string $msg) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body
    {
        margin: 0;
        padding: 0;
        background-image: linear-gradient(90deg, rgb(94, 94, 94),lightgray, white, lightgray, rgb(94, 94, 94));
    }

    div
    {
        text-align: center;
        font-size: 25px;
        font-weight: bold;
        margin-top: 20px;
    }
    </style>
    <title><?php echo $title; ?></title>
</head>
<body>
<div>
<?php
echo $msg;
?>
</div>
</body>
</html>
<?php
}
?>
