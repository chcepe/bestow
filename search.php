<?php
include("config.php");
if(!isset($_GET['keyword'])){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $head_title = "Searching for ".$_GET['keyword'].""; include("includes/header.php"); ?>
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
    <br>
    <div class="container">
    	<?php
            $result = mysql_query("SELECT * FROM `campaigns` WHERE `title` LIKE '%".$_GET['keyword']."%'");
            if(mysql_num_rows($result)==0){
                echo '<img src="assets/img/no-results.png" style="display: block; margin: auto; max-width: 200px; margin-top: 200px;">';
            }
            while ($row = mysql_fetch_assoc($result)){
        ?>
        <div class="item col-xs-6 col-sm-6 col-md-4">
            <a href="view.php?id=<?php echo $row['id'] ?>">
            <div class="thumbnail">
                <div class="main-img">
                    <img src="<?php echo $row['img']; ?>" class="img-responsive">
                    <div class="shadow"></div>
                    <span><?php echo $row['title']; ?></span>
                </div>
                <div class="meter"><div class="current" style="width: <?php echo (($row['current_donation']/$row['money'])*100) ?>%"></div></div>
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
