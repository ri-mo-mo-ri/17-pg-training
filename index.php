<?php
// トップページ
require_once 'functions.php';

session_start();
redirectToLoginPageIfNotLoggedIn();

$user_login_name = $_SESSION['user_login_name'];

$database = getDatabase();
$toots = $database->query("
  SELECT `user_id`, `text` FROM `toot`
")->fetchAll(PDO::FETCH_ASSOC);
var_dump($toots);
?>

<!-- 下にindex.htmlをコピペして、index.htmlを消そう！ -->
<html>
    <head>
        <title>Yastodon(ヤストドン)</title>
        <link rel="stylesheet" href="/css/style.css">
        <meta charset="utf-8">
    </head>
    <body>
        <div class="wrapper">
            <div class="container myself-container">
                <div class="myself">
                    <div class="user-icon"></div>
                    <div class="user-name"></div>
                </div>
                <form enctype="multipart/form-data" method="post" action="/post_toot.php">
                    <textarea name="text" placeholder="今なにしてる？" required></textarea>
                    <input type="file" name="image">
                    <div class="toot-button-container">
                        <input type="submit" class="toot-button" value="トゥート!">
                    </div>
                </form>
            </div>

            <div class="container toot-container">
                <div class="label icon-home"><img class="label-icon" src="img/home.png" width="15" alt="Home - ">ホーム</div>
               <ul>
              <?php foreach ($toots as $toot) {
              echo <<<EOT
               <li>
                   <img width="30"　 src="img/home.png">
                 <div>
                 <div class="yoko">
                    <div>名前</div>
                    <div>(@ID)</div>
                   </div>
                   <p> {$toot['text']} </p>
                 </div>
                </li>
EOT;
                
              }
                ?>


               </ul>
            </div>


            <div class="container about-container">
                <div class="label icon-asterisk"><img class="label-icon" src="/img/asterisk.png" width="15" alt="Start - ">スタート</div>
                <div class="contents">
                    <p>
                        Yastodonとは研修のために作られた教育用ソーシャル・ネットワーキング・サービスです。<br>
                        あなただけの素敵なサービスをここから成長させていってください。
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
