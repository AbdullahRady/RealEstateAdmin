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
            <li class="active">View Admin</li>
          </ol>
        </section>

<?php

	if(!isset($_GET['a']))
		header("Location: admins.php");
	else
	{
		$admin_id = $_GET['a'];
		
		include("config.php");
		
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

?>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
                <div class="box-header with-border">
                  <i class="fa fa-eye"></i> <h3 class="box-title">View Admin</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="firstname" class="col-sm-2 control-label">First Name</label>
                      <div class="col-sm-10">
                        <label for="firstname" class="form-control"><?= $admin_first_name ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="lastname" class="col-sm-2 control-label">Last Name</label>
                      <div class="col-sm-10">
                        <label for="firstname" class="form-control"><?= $admin_last_name ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <label for="firstname" class="form-control"><?= $admin_email ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="mobile" class="col-sm-2 control-label">Mobile</label>
                      <div class="col-sm-10">
                        <label for="firstname" class="form-control"><?= $admin_mobile ?></label>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="admins.php"><button type="button" class="btn btn-default">Cancel</button></a>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
