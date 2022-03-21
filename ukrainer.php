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
        <?php
        // ファイルが選択されているか確認
        if (empty($_FILES['image']['tmp_name'])) {
            echo '<p>アイコン画像を選択してください．</p>';
            echo '<button onclick="location.href=\'./index.php\'">画像を選択する</button>';
        } else {
            // 画像ファイルを受け取り
            $img = $_FILES['image'];
            // 画像ファイルのmimeタイプを取得
            $img_mime = mime_content_type($img['tmp_name']);
            // 画像のサイズを取得
            $width = getimagesize($img['tmp_name'])[0];
            $height = getimagesize($img['tmp_name'])[1];
            // 画像ファイルのmineタイプがimage/jpegだった場合
            if ($img_mime != 'image/jpeg' && $img_mime != 'image/png') {
                echo '<p>このファイルのMINEタイプは ' . $img_mime . ' です．</p>';
                echo '<p>画像ファイルは jpg（jpeg）か png を選択してください．</p>';
                echo '<br><button onclick="location.href=\'./index.php\'">別の画像を選択する</button>';
            } elseif ($width != $height) {
                echo '<p>正方形の画像を選択してください．</p>';
                echo '<br><button onclick="location.href=\'./index.php\'">別の画像を選択する</button>';
            } else {
                if ($img_mime == 'image/jpeg') {
                    $src_img = imagecreatefromjpeg($img['tmp_name']);
                } elseif ($img_mime == 'image/png') {
                    $src_img = imagecreatefrompng($img['tmp_name']);
                }
                // 画像ファイルを読み込み
                $bg_img = imagecreatefromjpeg("./img/bg.jpg");
                // 画像ファイルのサイズを取得
                $rect = imagesx($src_img);
                // 真ん中が透過色のマスク画像を用意
                $mask = imagecreatetruecolor($rect, $rect);
                // 背景色に緑(0, 255, 0)を指定して塗りつぶし(色は任意)
                $green = imagecolorallocate($mask, 0, 255, 0);
                imagefill($mask, 0, 0, $green);
                // マスクの透過色を指定(255, 0, 255)
                $mask_transparent = imagecolorallocate($mask, 255, 0, 255);
                imagecolortransparent($mask, $mask_transparent);
                // 中央の円を透過色で塗りつぶし
                imagefilledellipse($mask, $rect / 2, $rect / 2, $rect, $rect, $mask_transparent);
                // 元画像とマスク画像を重ね合わせ
                imagecopymerge($src_img, $mask, 0, 0, 0, 0, $rect, $rect, 100);
                // 余分な背景色の緑(0, 255, 0)を透過色に指定
                $src_transparent = imagecolorallocate($src_img, 0, 255, 0);
                imagecolortransparent($src_img, $src_transparent);
                // 画像を読み込み
                $bg_img = imagecreatefromjpeg("./img/bg.jpg");
                // $bg_imgと$src_imgをリサイズ
                $bg_img = imagescale($bg_img, imagesx($src_img) / 100 * 115, imagesy($src_img) / 100 * 115);
                // 画像を合成
                imagecopymerge($bg_img, $src_img, imagesx($bg_img) / 2 - $rect / 2, imagesy($bg_img) / 2 - $rect / 2, 0, 0, $rect, $rect, 100);
                // 画像をbase64エンコードして出力
                ob_start();
                imagepng($bg_img);
                $image_data = ob_get_contents();
                ob_end_clean();
                echo '<p>アイコン画像を作成しました！</p>';
                echo '<p>画像を長押し，または右クリックでダウンロードしてお使いください！（画像をクリックすると，新しいタブで開きます．）</p>';
                echo '<a href="data:image/png;base64,' . base64_encode($image_data) . '" target="_blank"><img src="data:image/png;base64,' . base64_encode($image_data) . '" width="25%"></a>';
                echo '<br><a href="data:image/png;base64,' . base64_encode($image_data) . '" download="Icon-Ukrainer.png"><button>アイコン画像をダウンロード</button></a>';
                echo '<br><button onclick="location.href=\'./index.php\'">別の画像を選択する</button>';
            }
        }
        ?>
        <p>何か問題があれば，<a href="https://twitter.com/sekaino_usay" target="_blank">U_SAY</a>までご連絡をお願いします．</p>
    </div>
    <footer>
        <small>
            <p>Source code is available on <a href="https://github.com/sekaino-usay/Icon-Ukrainer" target="_blank">GitHub</a></p>
            <p>Copyright © 2022 <a href=" https://icon-ukrainer.usay05.com" target="_blank">Icon Ukrainer</a> All Rights Reserved.</p>
        </small>
    </footer>
</body>

</html>