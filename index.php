<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $head_title = "Bestow: CrowdFunding & Fundraising Website"; include("includes/header.php"); ?>
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
<div class="container campaign-con">
    <div class="campaign-main">
        <div class="white-cover">
            <div class="white-footer"></div>
            <div class="content">
                <div class="col-md-12">
                    <div class="title-header">
                        Bestow for <span></span>
                    </div>
                    <div class="inner-addon left-addon">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <form method="get" action="search.php">
                        	<input placeholder="Search by name, illness, etc." type="text" name="keyword" autocomplete="off">
                        </form>
                    </div>
                    <a href="fbconfig.php" type="button" class="btn btn-block btn-warning" id="startCamp">Start a campaign</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    	<?php
            $result = mysql_query("SELECT * FROM `campaigns`");
            while ($row = mysql_fetch_assoc($result)){
                $sql = "SELECT SUM(amount) as sum FROM `donations` WHERE `campaign_id` = '".$row['id']."'";
                $current_donation = mysql_query($sql);
                $current_donation = mysql_fetch_array($current_donation);
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
        </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
