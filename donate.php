<?php
include("config.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $sql = "INSERT INTO donations(`amount`,`campaign_id`,`user_id`,`type`) values('".$_POST['amount']."', '".$_POST['campaign_id']."', '".$_SESSION['FBID']."', '".$_POST['type']."')";
   // echo $sql;
    mysql_query($sql);
    if($_POST['type']=="2"){
    	header("Location: view.php?id=".$_POST['campaign_id']);
    }
}else{
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $head_title = "Please wait.."; include("includes/header.php"); ?>
</head>
<body>
	<script>
		$(window).load(function () {
			window.setTimeout(function () {
				window.location.href = "<?php echo "view.php?id=".$_POST['campaign_id']; ?>";
			}, 5000)
		});
	</script>
    <?php include("includes/navbar.php"); ?>
    <img src="assets/img/animated-paypal-loading.gif" style="margin: 100px auto; width: 200px; display: block; border-radius: 40%;">
</body>
</html>
