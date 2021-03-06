<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Icon Ukrainer</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/main.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&family=Pacifico&display=swap" rel="stylesheet">
</head>

<body>
    <a href="./index.php"><img src="./img/logo.png" width="10%" alt="Icon Ukrainer"></a>
    <a href="./index.php" style="color: black; text-decoration: none;">
        <h1>Icon Ukrainer</h1>
    </a>
    <div>
        <p>アイコン画像の周りにウクライナ国旗色の枠を付けます．</p>
        <p>正方形の画像を選択して，「Ukrainer!」ボタンを押してください．ファイルの形式は jpg（jpeg）か png にしてください．</p>
        <form action="./ukrainer.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="image" accept=".png,.jpg,.jpeg" required>
            <br>
            <button type="submit">Ukrainer!</button>
        </form>
    </div>
    <footer>
        <small>
            <p>Source code is available on <a href="https://github.com/sekaino-usay/Icon-Ukrainer" target="_blank">GitHub</a></p>
            <p>Copyright © 2022 <a href=" https://icon-ukrainer.usay05.com" target="_blank">Icon Ukrainer</a> All Rights Reserved.</p>
        </small>
    </footer>
</body>

</html>