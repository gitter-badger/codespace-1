     <?php
     require 'core.inc.php';
     require 'connect.inc.php';
     if(loggedin()) header('Location:index.php');
      
if(!empty($_COOKIE['uid'])&&isset($_COOKIE['uid'])){$_SESSION['user_id']=$_COOKIE['uid'];
            header('Location: index.php');}/*to directly login in case of preset cookies*/
else {if(isset($_POST['uname'])&&isset($_POST['pword']))//check if the values are set i.e. form is submitted by user
{$usern=$_POST['uname'];//getting values using more secure post method
$passw=$_POST['pword'];

$hashed=md5($passw);

if(!empty($usern) && !empty($passw))/*check the fields are not empty*/
    {
    $query="SELECT id from user_in where username='".mysql_real_escape_string($usern)."' AND pword='".mysql_real_escape_string($hashed)."';";/*query to see any user is there with a given username and password*/
        
      if($result=mysql_query($query))/*run the query */
      { 
        $num_rows=mysql_num_rows($result);
        if($num_rows==0)/*check if no rows are returned there is no such user*/
          echo "<div class=\"\">Invalid Credentials</div>";
        else if($num_rows==1)
          { /*get user id from mysql table*/
            $us_id=mysql_result($result,0,'id');
            $t=time();
       /*check if the checkbox is selected to make cookies*/  
       if(isset($_POST['rmmbr'])&&!empty($_POST['rmmbr'])) setcookie('uid',$us_id,$t+60*60*24*365);

      /*start a session and send to index.php*/$_SESSION['user_id']=$us_id;
            
            
            header('Location:index.php');}
          
      }
    else echo "Problem Logging In";
    }//check all fields are filled
else echo "<div class=\"\">Please fill in all the fields</div>";
}}
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <title>CodeSpace</title>
  <link rel="shortcut icon" href="" type="image/x-icon" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.2.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.2.0/material.min.js"></script>
  
  <script src="js/jquery.min.js"></script>
  
  <link rel="stylesheet" href="css/deslog1.css" type="text/css">
  <style> 
body {
    text-align: center;
      }

  #file { display: none;}
  </style>

  <script>
    $(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
    });
  //alert($(window).height());
  //alert($(window).width());
    var h=$(window).height();
    var w=$(window).width();
    $('.page').height(h);
    $('.page').width(w);
    $('#login').height(h);
    $('#login').width(w); 
  </script>
</head>
<body>

  <style>
.demo-layout-transparent {
  background: #5890FF center / cover;
}
.demo-layout-transparent .mdl-layout__header,
.demo-layout-transparent .mdl-layout__drawer-button {
  /* This background is dark, so we set text to white. Use 87% black instead if
     your background is light. */
  color: white;
}
#logins{background:white;box-shadow:1px 1px 5px 1px;width:30%;margin-left:auto;margin-right:auto;margin-top:50px;margin-bottom:50px; }
</style>

<div class="demo-layout-transparent mdl-layout mdl-js-layout">
  <header class="mdl-layout__header mdl-layout__header--transparent">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">CodeSpace</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->
    <!--<nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
      </nav>-->
    </div>
  </header>
  <!--
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Title</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="">Link</a>
      <a class="mdl-navigation__link" href="">Link</a>
      <a class="mdl-navigation__link" href="">Link</a>
      <a class="mdl-navigation__link" href="">Link</a>
    </nav>
  </div>-->
  <main class="mdl-layout__content">
    
<div id="logins">
  <br>
  <h4>LOG IN</h4>
  <br>
<form method="post" action="log.php">
                  <br><br>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type ="text" name="uname" id="unam" maxlength="40" value="<?php if(isset($usern)) echo $usern;?>">
                    <label class="mdl-textfield__label" for="unam">
                      Username
                    </label>
                  </div>
                <br><br>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type ="password" name="pword" id="unam3" value="">
                  <label class="mdl-textfield__label" for="unam3">
                    Password
                  </label>
                </div>
                <br><br>
                
                <input type="checkbox" name=rmmbr id="rmmbr"><label for="rmmbr">Remember Me</label><br>
                <br><br>
                <input type="submit" value="LOG IN" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                  </form>
</div>





  </main>
</div>

    <script type="text/javascript" src=js/check.js></script>

</body>
</html>
