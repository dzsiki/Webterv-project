<?php
include_once "msg_page_generator.php";
session_start();
if (isset($_SESSION["user"]))
{
    session_unset();
    session_destroy();
    genMsgPage("Kijelentkezve.", "Kijelentkezve.");
    header("refresh:2; url=../index.php");
} else
{
    header("refresh:0; url=../index.php");
}
?>
