<?php
include("config.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $sql = "INSERT INTO comments(`campaign_id`,`message`,`user_id`, `date`) values('".$_POST['campaign_id']."', '".$_POST['comment']."', '".$_SESSION['FBID']."', NOW())";
    echo $sql;
    mysql_query($sql);
    header('Location: view.php?id='.$_POST['campaign_id']);
}
?>