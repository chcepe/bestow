<?php
include("config.php");

$sql = "SELECT id FROM users WHERE `id` = '".$_SESSION['FBID']."'";
$result = mysql_query($sql);
if (mysql_num_rows($result) > 0){
        header('Location: index.php');
        exit;
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $sql = "INSERT INTO users(`id`,`name`,`u_age`,`u_blood_type`,`u_email`) values('".$_SESSION['FBID']."', '".$_POST['name']."', '".$_POST['email']."', '".$_POST['blood']."', '".$_POST['email']."')";
    mysql_query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $head_title = "User Info"; include("includes/header.php"); ?>
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
    <div class="container container-marg">
            <h3>Basic Information</h3> 
    <form class="user.php" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo  $_SESSION['FULLNAME']; ?>" readonly="true">
        </div>
        <div class="form-group">
            <label for="Age">Age</label>
            <select class="form-control" name="age" id="age" required>
                <?php for($x = 18; $x < 60; $x++){ ?>
                    <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="blood">Blood Type</label>
            <select class="form-control" name="blood" id="blood" required>
                    <option value="A">A</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                    <option value="B">B</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Paypal Email</label>
            <input type="text" id="email" name="email" class="form-control" placeholder="Your paypal email" required>
        </div>
        <button type="submit" class="btn btn-block btn-danger"><i class="fa fa-check-circle" aria-hidden="true"></i> Save Info</button>
    </form>
    </div>
</div>
</body>
</html>