<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">

        <div class="navbar-header">
            <button button="" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" rel="home" href="index.php">
                <img style="max-width: 150px; margin-top: -8px;" src="http://localhost/bestow/assets/img/nav-logo.png">
            </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <li class="<?php if(basename($_SERVER['PHP_SELF'])=="index.php"){ echo 'active'; } ?>"><a href="index.php">Home</a></li>
                <?php if ($_SESSION['FBID']!=NULL){ ?>
                <li class="<?php if(basename($_SERVER['PHP_SELF'])=="my_campaigns.php"){ echo 'active'; } ?>"><a href="my_campaigns.php">My Campaigns</a></li>
                <?php } ?>
            </ul>
            <form class="navbar-form navbar-right" role="search" method="get" id="searchform" action="">
                <div class="form-group">
                <?php if ($_SESSION['FBID']==NULL): ?>
                    <a class="btn btn-block btn-social btn-reddit" href="fbconfig.php">
                        <span class="fa fa-facebook"></span> Sign in with Facebook
                    </a>
                <?php else: ?> 
                    <a class="btn btn-social btn-success" href="add_campaign.php">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Create campaign
                    </a>
                    <a class="btn btn-social btn-danger logout" href="logout.php">
                        <img src="https://graph.facebook.com/<?php echo  $_SESSION['FBID']; ?>/picture" class="img-circle"> Logout
                    </a>
                <?php endif ?>
                </div>
            </form>
        </div>

    </div>
</div>