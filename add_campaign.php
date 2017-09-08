<?php
include("config.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $title = mysql_real_escape_string($_POST['title']);
    $story = mysql_real_escape_string($_POST['story']);
    $tags = $_POST['tags'];
    $loc = $_POST['loc'];
    $money = $_POST['money'];
    if(isset($_POST['blood'])){
        $blood = 1;
    }else{
        $blood = 0;
    }
    if (isset($_FILES['image']["name"])) {
                echo $sql;
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_name = $_FILES['image']['name'];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name = md5($file_name.time()).".".$ext;
            $location = "photos/".$file_name;
            if (move_uploaded_file($file_tmp, $location)) {
                $sql = "INSERT INTO campaigns (`title`, `story`, `img`, `tags`, `loc`, `date`, `money`, `blood_donation`) VALUES ('".$title."', '".$story."', '".$location."', '".$tags."', '".$loc."', NOW(), '".$money."', ".$blood.")";
                //echo $sql;
                $result = mysql_query($sql);
                header("Location: index.php");
            } else {
                echo "File was not uploaded";
            }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $head_title = "Add Campaign"; include("includes/header.php"); ?>
</head>
<body>
    <?php include("includes/navbar.php"); ?>
	<div class="container container-marg">
        <div class="col-md-6 col-md-offset-3">
            <form class="add_campaign.php" enctype="multipart/form-data" method="POST">
            <div class="row">
                <div class="upload col-md-8 col-md-offset-2 thumbnail">
                    <img src="assets/img/upload.png" class="img-responsive">
                    <div class="cover"><input type="file" id="file_thumb" name="image" accept="image/*"></div>
                </div>
            </div>
            <div class="row">
                    <div class="form-group">
                        <label for="title">Campaign Title</label>
                        <input type="text" name="title" placeholder="Your campaign title" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="loc">Location</label>
                        <input type="text" name="loc" placeholder="Type your location" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="story">Story</label>
                        <textarea class="form-control" name="story" placeholder="Your story" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" name="tags" placeholder="Type your tags (comma seperated)" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="money">Target money ($) for this campaign</label>
                        <div class="input-group spinner">
                            <input class="form-control" id="money" name="money" value="100" min="100" max="100000" type="text" readonly="">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="blood">Does this campaign needs blood donation?</label>
                        <div class="checkbox">
                            <label><input type="checkbox" name="blood" value="">Yes</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-warning"><i class="fa fa-check-circle" aria-hidden="true"></i> Submit campaign</button>
            </div>
            </form>
        </div>
    </div>
</body>
</html>