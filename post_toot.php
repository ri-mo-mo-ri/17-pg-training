<?php
require_once 'functions.php';
// トゥート投稿

session_start();
redirectToLoginPageIfNotLoggedIn();
var_dump($_POST);
$text = $_POST['text'];
$user_id = $_SESSION['user_id'];
$database = getDatabase();

$database->query("
    INSERT INTO `toot`( `user_id`, `text`) VALUES ($user_id,'{$text}')
")->execute();


header('Location: /');
