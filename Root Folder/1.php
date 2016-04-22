<?php
$video_file = 'mp4_video.mp4';
 
$flvfile ='test.flv';
 
$png_path ='mp4_image4.png';
 
/* exec("ffmpeg -i ".$video_file."  -ab 56 -ar 44100 -b 200 -r 15 -s 320x240 -f flv ".$flvfile.""); */
 
//for thumbnail 
exec("ffmpeg -y -i ".$video_file." -vframes 1 -ss 00:00:01 -an -vcodec png -f rawvideo -s 110x90 ".$png_path."");

$png_path ='mp4_image_image4.png';

exec("ffmpeg -y -i ".$video_file." -vframes 1 -ss 00:00:05 -an -vcodec png -f rawvideo -s 110x90 ".$png_path."");

echo "success <br/> <br/> <br/>";

echo "------------------------------------------------- <br />";
echo "------------------------------------------------- <br />";

$image_size     = "300x240";
$percent        = 50; /*- Screen shot for middle -*/

/*- Getting Video duration -*/
ob_start();
passthru("ffmpeg -i \"". $video_file . "\" 2>&1");
$duration = ob_get_contents();
ob_end_clean();

preg_match('/Duration: (.*?),/', $duration, $matches);
$duration = $matches[1];
$duration_array = explode(':', $duration);
$duration = $duration_array[0] * 3600 + $duration_array[1] * 60 + $duration_array[2];
$time = $duration * $percent / 100;

/*- Middle Hours -*/
$hours = intval(($time-(intval($time/3600)*3600))/60);
$hours = round($hours, 0, PHP_ROUND_HALF_UP);
$hours = ($hours <=9 ) ? "0".$hours  : $hours;

/*- Middle Mintuz  -*/
$mints = intval($time/3600); 
$mints = round($mints, 0, PHP_ROUND_HALF_UP);
$mints = ($mints <=9 ) ? "0".$mints  : $mints;

/*- Middle Seconds -*/
$seconds =  sprintf("%01.3f", ($time-(intval($time/60)*60)));
$seconds = round($seconds, 0, PHP_ROUND_HALF_UP);
$seconds = ($seconds <=9 ) ? "0".$seconds  : $seconds;
$time = $hours. ":" . $mints . ":" . $seconds;

exec("ffmpeg -y -i ".$video_file." -vframes 1 -ss $time -an -vcodec png -f rawvideo -s  ". $image_size ." ".$png_path."");

?>