<?php
require("siteinfo.php");


?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo $siteinfo_title;?> &raquo; Log In</title>
  <link rel="stylesheet" href="theme/login.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<br>
<br>
<br>
<center>
<a href="/"><img src="css/images/logob.png"/></a>
</center>
  <form class="login" action="users.php?act=login-d" method="post">
    <h1><?php echo $siteinfo_title;?></h1>
    <input type="text" name="username" class="login-input" placeholder="Username" autofocus>
    <input type="password" name="password" class="login-input" placeholder="Password">
    <input type="submit" value="Login" class="login-submit">
    <p class="login-help"><a href="javascript:void(0);" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>'); toggle_lightbox('users.php?act=lost_password', 'lost_password_lightbox');">Forgot password?</a></p>
  </form>
</body>
</html>
