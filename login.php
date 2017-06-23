<?php

	if(isset($_POST['login']))
	{
		include("config.php");
		
		$loginemail=$_POST['loginemail']; 
		$loginpassword=$_POST['loginpassword'];
		
		//Hashing password
		$loginpassword = md5("$loginpassword");
		
		$login_query = 
		"
			SELECT * FROM user 
			WHERE usr_email = '$loginemail' 
			AND usr_password = '$loginpassword' 
			AND usr_type = 1
		";
		$user_login = mysql_query($login_query);
		
		$user_count = mysql_num_rows($user_login);
		
		if($user_count > 0)
		{
			session_start();
			
			$_SESSION['adminlogin'] = $loginemail;
			header("location: index.php");

		}
		else 
		{
			header("location: login.php?e=1");
		}
	}
	
?>
	
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>El Sawy Group Admin | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminTh.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">

<?php

		if(isset($_GET['e']))
		{
			if($_GET['e'] == 1)
			{
				$notification_title = "Invalid User";
				$notification_message = "Please make sure you enter correct email and password, and you are aurothized to access this page";				
			}
				
			echo
			'
          <div class="row">
            <div class="col-md-12">
			  		
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> '.$notification_title.'</h4>
					'.$notification_message.'
				</div>	
			  	
            </div>
		  </div>						
			';	
		}

?>

					
  
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><img src="images/logo_w.png" width="156" height="30"></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Admin Gate</p>
        <form name="loginform" method="post" action="<?= $_SERVER['PHP_SELF'];?>">
          <div class="form-group has-feedback">
            <input name="loginemail" type="email" class="form-control" placeholder="Email" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="loginpassword" type="password" class="form-control" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
            <!--
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
             --> 
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button name="login" type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
            </div><!-- /.col -->
          </div>
        </form>

        

        <!-- <a href="#">I forgot my password</a><br> -->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
