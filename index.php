<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Icon Ukrainer</title>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <h1>Icon Ukrainer</h1>
    <p>アイコン画像の周りにウクライナ国旗色の枠を付けます．</p>
    <p>正方形の画像を選択してください．ファイルの形式はjpgかpngにしてください．</p>
    <form action="./ukrainer.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <input type="submit" value="送信">
    </form>
</body>

</html>