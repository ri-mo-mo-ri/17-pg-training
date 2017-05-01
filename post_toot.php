<?php
require_once 'functions.php';
// トゥート投稿

session_start();
redirectToLoginPageIfNotLoggedIn();
$text = $_POST['text'];
$user_id = $_SESSION['user_id'];
$database = getDatabase();

$database->query("
    INSERT INTO `toot`( `user_id`, `text`, `created_at`) VALUES ($user_id,'{$text}',cast(now() as datetime))
");


header('Location: /');
