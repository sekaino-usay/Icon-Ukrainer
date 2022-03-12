<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Icon Ukrainer</title>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <?php
    // 画像ファイルを受け取り
    $img = $_FILES['image'];
    // 画像ファイルの拡張子を取得
    $img_extension = pathinfo($img['name'], PATHINFO_EXTENSION);
    // 画像ファイルの拡張子がjpgかpngか判定
    if ($img_extension == "jpg") {
        $src_img = imagecreatefromjpeg($img['tmp_name']);
    } elseif ($img_extension = "png") {
        $src_img = imagecreatefrompng($img['tmp_name']);
    } else {
        echo "画像ファイルを選択してください";
        exit;
    }
    // 画像ファイルのサイズを取得
    $src_width = imagesx($src_img);
    $src_height = imagesy($src_img);
    // 正方形かどうか判定
    if ($src_width != $src_height) {
        echo "正方形の画像を選択してください．";
        exit;
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
    $bg_img = imagecreatefromjpeg("img/bg.jpg");
    // $bg_imgと$src_imgをリサイズ
    $bg_img = imagescale($bg_img, imagesx($src_img) / 100 * 115, imagesy($src_img) / 100 * 115);
    // 画像を合成
    imagecopymerge($bg_img, $src_img, imagesx($bg_img) / 2 - $rect / 2, imagesy($bg_img) / 2 - $rect / 2, 0, 0, $rect, $rect, 100);
    // 画像をbase64エンコードして出力
    ob_start();
    imagepng($bg_img);
    $image_data = ob_get_contents();
    ob_end_clean();
    echo '<img src="data:image/png;base64,' . base64_encode($image_data) . '">';
    ?>
</body>

</html>