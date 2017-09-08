<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $head_title = "My campaigns".$_GET['keyword'].""; include("includes/header.php"); ?>
</head>
<body>
	<script>
	  $(function(){
	      $(".title-header span").typed({
	        strings: ["Family.", "a Friend.", "a Schoolmate.", "a Stranger."],
	        typeSpeed: 0
	      });
	  });
	</script>
    <?php include("includes/navbar.php"); ?>
<div class="container">
        <?php
            $result = mysql_query("SELECT * FROM `campaigns` WHERE `user_id` = '".$_SESSION['FBID']."'");
            while ($row = mysql_fetch_assoc($result)){
                $sql = "SELECT SUM(amount) as sum FROM `donations` WHERE `campaign_id` = '".$row['id']."'";
                $current_donation = mysql_query($sql);
                $current_donation = mysql_fetch_array($current_donation);
                if($current_donation)
        ?>
        <div class="item col-xs-6 col-sm-6 col-md-4">
            <a href="view.php?id=<?php echo $row['id'] ?>">
            <div class="thumbnail">
                <div class="main-img">
                    <img src="<?php echo $row['img']; ?>" class="img-responsive">
                    <div class="shadow"></div>
                    <span><?php echo $row['title']; ?></span>
                </div>
                <div class="meter"><div class="current" style="width: <?php echo (($current_donation['sum']/$row['money'])*100) ?>%"></div></div>
            </div>
            </a>
            <span><b>$<?php if($current_donation['sum']!=''){ echo $current_donation['sum']; }else{ echo '0'; } ?></b> raised out of $<?php echo $row['money']; ?></span>
            <p><?php echo $row['story']; ?></p>
            <div class="col-md-6"><button class="btn btn-warning col-md-12"><i class="fa fa-pencil" aria-hidden="true"></i></button></div>
            <div class="col-md-6"><button class="btn btn-danger col-md-12"><i class="fa fa-trash" aria-hidden="true"></i></button></div>
        </div>
        <?php } ?>
</div>
</body>
</html>
