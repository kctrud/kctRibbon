<?
// Формируем изображение специального статуса
// https://github.com/kctrud/kctRibbon

if (isset($_GET['s'])) {
  $status = $_GET['s'];
}
else {
  exit("No label string! Use: <a href='special_status.php?s=kctRibbon'>special_status.php?s=kctRibbon</a>");
}

// NOTE: Ribbon options
$recept = array(
  array('template' => 'tp0.png', 'size' => 30, 'font' => 'OpenSans-ExtraBold', 'angle' => 3, 'xoffset' => -3, 'yoffset' => 3),
  array('template' => 'tp1.png', 'size' => 30, 'font' => 'OpenSans-ExtraBold', 'angle' => -3, 'xoffset' => -3, 'yoffset' => 2),
  array('template' => 'tp2.png', 'size' => 30, 'font' => 'OpenSans-ExtraBold', 'angle' => 2, 'xoffset' => -2, 'yoffset' => 10),
  array('template' => 'tp3.png', 'size' => 30, 'font' => 'OpenSans-ExtraBold', 'angle' => -3, 'xoffset' => 2, 'yoffset' => 8),
  array('template' => 'tp4.png', 'size' => 30, 'font' => 'OpenSans-ExtraBold', 'angle' => -2, 'xoffset' => -2, 'yoffset' => 5),
  array('template' => 'tp5.png', 'size' => 30, 'font' => 'OpenSans-ExtraBold', 'angle' => 1, 'xoffset' => -2, 'yoffset' => 7),
);

// NOTE: Generate image
if (!empty($status)) {
  $string = mb_strtoupper($status);
  $template = $recept[rand(0,count($recept)-1)];
  $im = imagecreatefrompng($template['template']);
  $size = getimagesize($template['template']);
  imagesavealpha($im, true);
  $lime = imagecolorallocate($im, 255, 255, 255);
  $phpbb_root_path = "../kctRibbon/";
  $tb = imagettfbbox($template['size'], $template['angle'], $phpbb_root_path.$template['font'].'.ttf', $string);
  $x = ceil(($size[0] - $tb[2]) / 2) + $template['xoffset'];
  $y = ceil(($size[1] - $tb[3]) / 2) + $template['yoffset'];
  imagettftext($im, $template['size'], $template['angle'], $x, $y, $lime, $phpbb_root_path.$template['font'].'.ttf', $string);
  //exit();
  $type = 'image/png';
  header('Content-Type:'.$type);
  imagepng($im);
  imagedestroy($im);
}
