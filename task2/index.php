<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>

<body>
    <?php
    function resize_imagepng($file, $w, $h)
    {
        list($width, $height) = getimagesize($file);
        $src = imagecreatefrompng($file);
        $dst = imagecreatetruecolor($w, $h);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
        return $dst;
    }
    $img = resize_imagepng('image.png', 200, 150);
    imagepng($img, 'cropped.png');
    ?>
    <img src="cropped.png" alt="" srcset="">
</body>

</html>