<?php

require_once('fanty.php');

$actual_link = "$_SERVER[REQUEST_URI]";
$actual_link = explode('/', $actual_link);
$hash = end($actual_link);
$db = new DB();
$result = $db->ask('select * from tracking_details');
if($result->num_rows==0){
	header('Content-Type: image/png');
	echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');
	die;
}
$result = $db->convert($result);
$result = end($result);
$new_view_count = (int)$result['views'];
$read_time = $result['read_time'];

$now = new DateTime();
$now = $now->getTimestamp();   

if($read_time==NULL && $new_view_count==0){
	$q = "UPDATE tracking_details set views = '".($new_view_count+1)."', read_time = '".($now)."' where hash='".$hash."'";
}else{
	$q = "UPDATE tracking_details set views = '".($new_view_count+1)."' where hash='".$hash."'";
}

$result = $db->ask($q);

header('Content-Type: image/png');
echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');
die;

?>