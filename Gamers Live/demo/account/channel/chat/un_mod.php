
<?php
error_reporting(0);
include_once("../../../config.php");
include_once("../../../analyticstracking.php");


session_start();



include_once("".$conf_ht_docs_gl."/analyticstracking.php");
if ($_SESSION['access'] != true) {
    header( 'Location: '.$conf_site_url.'/account/login/?msg=Please login to view this page' ) ;
    exit;
}
$mod_name = $_SESSION['channel_id'];

$username = $_GET['user'];

$channel_id = $_GET['channel'];


if($mod_name == $channel_id){
    $can_ban = true;
}

$staff_check = mysql_query("SELECT * FROM channels WHERE channel_id='$mod_name' AND admin='1'");
$staff_check_count = mysql_num_rows($staff_check);
if($staff_check_count == 1){
    $can_ban = true;
}


if($can_ban == true){
    // we will unban
    $unban = mysql_query("UPDATE chat_mods SET moderator='0' WHERE channel_id='$channel_id' AND user_id='$username'") or die(mysql_error());
    $msg = 'You have removed '.$username.' as a moderator';
}else{
    $msg = 'You cannot delete moderators on this channel.';
}
?>
<link href="<?=$conf_site_url?>/style.css" media="screen" rel="stylesheet" type="text/css" />
<title>Chat Moderators</title>
<center><h3><?=$msg?></h3></center>