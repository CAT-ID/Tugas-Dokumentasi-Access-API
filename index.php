<?php
header('Content-Type: application/json');
$text = $_POST['text'];
$image = $_FILES['image']['name'];

$filedest = dirname(__FILE__) .'/'. $image;
move_uploaded_file($_FILES['image']['tmp_name'], $filedest);

$im = imagecreatefrompng($image);

if($im && imagefilter($im, IMG_FILTER_PIXELATE, 50))
{
    imagepng($im, $image);
    $text = strtoupper(str_replace(" ","_",$text));
    print_r(json_encode((object) array(
      'text' => $text,
      'image' => $image,
     )));
}
else
{
  print_r(json_encode((object) array(
    'text' => "Error",
    'image' => "",
   )));
}

imagedestroy($im);
?>
