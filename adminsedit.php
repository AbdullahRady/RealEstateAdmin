<?php $page_title = "Admins"; ?>
<?php include ("includes/header.php");?>
<?php include ("includes/sidebar.php"); ?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?= $page_title ?>
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="careers.php">Users</a></li>
            <li><a href="admins.php"><?= $page_title ?></a></li>
            <li class="active">Edit Admin</li>
          </ol>
        </section>

<?php

	if(!isset($_GET['a']))
		header("Location: admins.php");
	else
	{
		$admin_id = $_GET['a'];
		
		include("config.php");
		
		if(isset($_POST['updateadmin']))
		{
			
			$admin_first_name = $_POST['firstname']; 
			$admin_last_name = $_POST['lastname'];
			$admin_email = $_POST['email'];
			$admin_mobile = $_POST['mobile'];
					
			$admin_query = 
			"
				UPDATE user 
				SET usr_first_name ='$admin_first_name', usr_last_name = '$admin_last_name', usr_email = '$admin_email', usr_mobile = '$admin_mobile'  
				WHERE usr_type = 1 
				AND usr_id = '$admin_id'
			";
			$admin_sql = mysql_query($admin_query);
			
			if($admin_sql)
			{
				$e = 0;
			}
			else
			{
				$e = 1;
			}
			
		}
		else
		{
			$admin_query = 
					"
						SELECT *
						FROM user
						WHERE usr_type = 1 
						AND usr_id = '$admin_id'
						LIMIT 1
					";
			
			$admin_sql = mysql_query($admin_query);
			
			$admin_count = mysql_num_rows($admin_sql);	
			
			if($admin_count == 0)
				header("Location: admins.php");
			
			while($admin_row  = mysql_fetch_array($admin_sql))
			{
				$admin_id = $admin_row['usr_id'];
				$admin_first_name = $admin_row['usr_first_name'];
				$admin_last_name = $admin_row['usr_last_name'];
				$admin_email = $admin_row['usr_email'];
				$admin_mobile = $admin_row['usr_mobile'];
			}
			
		}
				
	}

?>

        <!-- Main content -->
        <section class="content">
<?php

	if(isset($e))
	{
		if($e != 0)
		{
			$notification_title = "Failed";
			
			if($e == 1)
				$notification_message = "There was an error updating admin";
		}
		else
		{
			header("location: admins.php?s=2");
		}
			
		echo
		'
	  <div class="row">
		<div class="col-md-12">
				
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-warning"></i> '.$notification_title.'</h4>
				'.$notification_message.'
			</div>	
			
		</div>
	  </div>						
		';	
	}
?>

          <!-- Default box -->
          <div class="box">
                <div class="box-header with-border">
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Edit Admin</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="adminform" action="<?= $_SERVER['PHP_SELF'];?>?a=<?= $admin_id ?>" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="firstname" class="col-sm-2 control-label">First Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?= $admin_first_name ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="lastname" class="col-sm-2 control-label">Last Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?= $admin_last_name ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $admin_email ?>" required>
                      </div>
                    </div>
                    <!--
                    <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="repeatpassword" class="col-sm-2 control-label">Repeat Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="repeatpassword" placeholder="Repeat Password" required>
                      </div>
                    </div>
                    -->
                    <div class="form-group">
                      <label for="mobile" class="col-sm-2 control-label">Mobile</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" name="mobile" placeholder="Mobile" value="<?= $admin_mobile ?>">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="admins.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right" name="updateadmin">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
