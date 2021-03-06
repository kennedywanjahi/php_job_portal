<?php
session_start();
include_once 'classes/userManagementClass.php';
$user = new User();
if (isset($_SESSION['uid'])) {
$uid = $_SESSION['uid'];
$fullname = $user->get_fullname($uid);
$Mobile = $user->get_Mobile($uid);

}

 ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Jonaki | Job Board Template</title>
        <meta name="description" content="company is a free job board template">
        <meta name="author" content="Ohidul">
        <meta name="keyword" content="html, css, bootstrap, job-board">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/owl.theme.css">
        <link rel="stylesheet" href="css/owl.transitions.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="responsive.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>

        <!-- <div id="preloader">
            <div id="status">&nbsp;</div>
        </div> -->
        <!-- Body content -->

        <div class="header-connect">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-8 col-xs-8">
                        <div class="header-half header-call">
                            <p>
                              <?php if (isset($_SESSION['current_user'])) {?>
                                <span><a href='account.php?source=profile&&user_id=<?php echo $_SESSION['uid']; ?>'><i class='fa fa-user'></i><?php echo $_SESSION['current_user']; ?></a></span>
                                <span><a href="applications.php"><i class="fa fa-heart"></i>My Applications</a></span>
				                        <span><a href='account.php?q'><i class='fa fa-power-off'></i> Log Out</a></span>
                              <?php } else {
                                ?>
                                <span><a href="account.php"><i class=" fa fa-user"></i> My Account</a></span>
                              <?php } ?>
                            </p>
                        </div>
                    </div>
                    <?php if (!isset($_SESSION['current_user'])) {?>
                    <div class="col-md-2 col-md-offset-5  col-sm-3 col-sm-offset-1  col-xs-3  col-xs-offset-1">
                        <a href="employers"><button class="btn btn-primary wow bounceInRight login" data-wow-delay="0.6s">FOR EMPLOYERS</button></a>
                    </div>
                  <?php } ?>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-default">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><img src="img/logo.png" alt="its us"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <div class="button navbar-right">
                <?php if (!isset($_SESSION['current_user'])) {?>
                  <a href="account.php"><button class="navbar-btn nav-button wow bounceInRight login" data-wow-delay="0.8s">Login</button></a>
                  <a href="account.php?source=register"><button class="navbar-btn nav-button wow fadeInRight" data-wow-delay="0.6s">Sign up</button></a>
                <?php } ?>
              </div>
              <ul class="main-nav nav navbar-nav navbar-right">
                <li class="wow fadeInDown" data-wow-delay="0s"><a class="active" href="index.php">HOME</a></li>
                <li class="wow fadeInDown" data-wow-delay="0.1s"><a href="jobs.php">JOBS</a></li>
                <li class="wow fadeInDown" data-wow-delay="0.3s"><a href="#">ABOUT US</a></li>
                <li class="wow fadeInDown" data-wow-delay="0.3s"><a href="#">LEAVE US A MESSAGE</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
          </nav>
