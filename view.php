<?php
include("config.php");
if(!isset($_GET['id'])){
    header('Location: index.php');
}
$sql = "SELECT * FROM campaigns WHERE `id` = '".$_GET['id']."'";
$result = mysql_query($sql);
$value = mysql_fetch_array($result);
if (mysql_num_rows($result) < 0){
        header('Location: index.php');
        exit;
}
$sql = "SELECT SUM(amount) as sum FROM `donations` WHERE `campaign_id` = '".$_GET['id']."'";
$current_donation = mysql_query($sql);
$current_donation = mysql_fetch_array($current_donation);
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $head_title = $value['title']; include("includes/header.php"); ?>
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
    <div class="container info">
    	<div class="col-md-9">
        <div style="position: relative;">
            <div class="white-footer"></div>
            <img src="<?php echo $value['img']; ?>" class="img-responsive">
        </div>
            <h3><?php echo $value['title']; ?></h3>
<?php
$sql = "SELECT * FROM users WHERE `id` = '".$value['user_id']."'";
$result = mysql_query($sql);
$user = mysql_fetch_array($result);
?>
            <img src="https://graph.facebook.com/<?php echo $user['id']; ?>/picture" class="img-circle author">
            <span class="author">By <b><?php echo $user['name']; ?></b></span>
            <blockquote><?php echo $value['story']; ?></blockquote>
        </div>
        <div class="col-md-3">
            <span><b>$<?php if($current_donation['sum']!=''){ echo $current_donation['sum']; }else{ echo '0'; } ?></b> raised out of $<?php echo $value['money']; ?> goal</span>
            <div class="progress">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (($current_donation['sum']/$value['money'])*100) ?>%">
                    <span class="sr-only">40% Complete (success)</span>
                </div>
            </div>
            <form action="donate.php" method="POST">
                <div class="input-group spinner" style="margin-bottom: 2px;">
                    <input class="form-control" id="money" name="amount" value="100" min="100" max="100000" readonly="" type="text">
                    <div class="input-group-btn-vertical">
                        <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                        <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                    </div>
                </div>
                <input type="hidden" name="campaign_id" value="<?php echo $_GET['id']; ?>">
                <input type="hidden" name="type" value="1">
                <button class="btn btn-danger btn-block"><i class="fa fa-check" aria-hidden="true"></i> Donate now</button>
                <br>
            </form>
            <button class="btn btn-block btn-social btn-facebook" onclick="popitup('http://facebook.com/share.php?u=<?php echo $actual_link; ?>')"><span class="fa fa-facebook"></span> Share on Facebook</button>
            <button class="btn btn-block btn-social btn-twitter" onclick="popitup('https://twitter.com/intent/tweet?text=<?php echo urlencode("Read: ".$value['title'].""); ?>&tw_p=tweetbutton&url=<?php echo urlencode($actual_link); ?>')"><span class="fa fa-twitter"></span> Share on Twitter</button>
            <br>
            <div class="panel panel-default">
                <div class="panel-heading">They need blood donators</div>
                <div class="panel-body">
                <form action="donate.php" method="POST">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="campaign_id" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="type" value="2">
<?php
$sql = "SELECT * FROM `donations` WHERE `campaign_id` = '".$_GET['id']."' AND `type` = '2'";
$result = mysql_query($sql);
if(mysql_num_rows($result)>0){
    $disabled = true;
}else{
    $disabled = false;
}
?>
                    <button class="btn btn-danger btn-block" disabled="<?php echo $disabled; ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i> I am willing to donate</button>
                </form>
                </div>
            </div>
            <br>
            <div class="panel panel-default">
                <div class="panel-heading">Willing to Donate Blood</div>
                <div class="panel-body">
                    <ul>
        <?php
            $sql = "SELECT * FROM `donations` WHERE `campaign_id` = '".$_GET['id']."' AND `type` = '2'";
            //echo $sql;
            $result = mysql_query($sql);
            if(mysql_num_rows($result)==0){
                echo 'The are no blood donators on this campaign, as of now.';
            }
            while ($row = mysql_fetch_assoc($result)){
            $sql = "SELECT name, id FROM `users` WHERE `id` = '".$row['user_id']."'";
            $result1 = mysql_query($sql);
            $id = mysql_fetch_array($result1);
        ?>
                        <li>
                            <img src="https://graph.facebook.com/<?php echo $id['id'] ?>/picture" class="img-circle">
                            <p>
                                <span class="name"><?php echo $id['name'] ?></span>
                            </p>
                        </li>
        <?php } ?>
                    </ul>
                </div>
            </div>
            <br>
            <div class="panel panel-default">
                <div class="panel-heading">Recent Donators ($)</div>
                <div class="panel-body">
                    <ul>
        <?php
            $result = mysql_query("SELECT * FROM `donations` WHERE `id` = '".$_GET['id']."' AND `type` = '1'");
            if(mysql_num_rows($result)==0){
                echo 'The are no donators on this campaign, as of now.';
            }
            while ($row = mysql_fetch_assoc($result)){
            $sql = "SELECT name, id FROM `users` WHERE `id` = '".$row['user_id']."'";
            $result1 = mysql_query($sql);
            $id = mysql_fetch_array($result1);
        ?>
                        <li>
                            <img src="https://graph.facebook.com/<?php echo $id['id'] ?>/picture" class="img-circle">
                            <p>
                                <span class="name"><?php echo $id['name'] ?></span>
                                <span class="price">$<?php echo $row['amount'] ?></span>
                            </p>
                        </li>
        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <form action="comment.php" method="POST">
                <div class="col-sm-11 col-xs-7">
                    <input type="hidden" name="campaign_id" value="<?php echo $_GET['id']; ?>">
                    <textarea class="form-control" name="comment" placeholder="Your comment.." required=""e></textarea>
                </div>
                <div class="col-sm-1 col-xs-5">
                    <button type="submit" class="btn btn-danger btn-block" style="height: 100px"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
        <div class="row">
              <div class="container">
              <br><br>
                <div class="row">
        <?php
            $result = mysql_query("SELECT * FROM `comments` WHERE `campaign_id` = '".$_GET['id']."'");
            while ($row = mysql_fetch_assoc($result)){

            $sql = "SELECT name FROM `users` WHERE `id` = '".$row['user_id']."'";
            $result1 = mysql_query($sql);
            $id = mysql_fetch_array($result1);
        ?>
                    <div class="col-xs-2 col-sm-1">
                        <div class="thumbnail">
                            <img class="img-responsive user-photo" src="https://graph.facebook.com/<?php echo $row['user_id']; ?>/picture">
                        </div>
                    </div>

                    <div class="col-xs-10 col-sm-11">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong><?php echo $id['name']; ?></strong> <span class="text-muted"><?php echo $row['date']; ?></span>
                            </div>
                            <div class="panel-body">
                                <?php echo $row['message']; ?>
                            </div>
                        </div>
                    </div>
        <?php } ?>
                </div>
            </div>          
        </div>
    </div>
</div>
</body>
</html>
