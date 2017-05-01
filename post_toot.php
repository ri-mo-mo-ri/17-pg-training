<?php
require_once 'functions.php';
// トゥート投稿

session_start();
redirectToLoginPageIfNotLoggedIn();
$text = $_POST['text'];
$user_id = $_SESSION['user_id'];
$database = getDatabase();

//ファイルがアップロードされた時
if(is_uploaded_file($_FILES['uploaded-image']['tmp_name'])){

//一時ファイルからuploaded-imageに移動
        if(move_uploaded_file($_FILES['uploaded-image']['tmp_name'],
        "./uploaded_image/".$_FILES['uploaded-image']['name'])){
           $image_name = $_FILES['uploaded-image']['name'];
          
           $database->query("
             INSERT INTO `toot`( `user_id`, `text`, `created_at` , `image_file_name`)
             VALUES ($user_id,'{$text}',cast(now() as datetime), '{$image_name}')
         ");
        //アップロード失敗
      }else{echo '失敗';



        }

    }else{
      //テキストのみ
      $database->query("
        INSERT INTO `toot`( `user_id`, `text`, `created_at`) VALUES ($user_id,'{$text}',cast(now() as datetime))
    ");



    }



header('Location: /');
