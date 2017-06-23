<?php $page_title = "Clients"; ?>
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
            <li><a href="clients.php"><?= $page_title ?></a></li>
            <li class="active">View Client</li>
          </ol>
        </section>

<?php

	if(!isset($_GET['c']))
		header("Location: clients.php");
	else
	{
		$client_id = $_GET['c'];
		
		include("config.php");
		
		$client_query = 
				"
					SELECT *
					FROM user
					WHERE usr_type != 1 
					AND usr_id = '$client_id'
					LIMIT 1
				";
		
		$client_sql = mysql_query($client_query);
		
		$client_count = mysql_num_rows($client_sql);	
		
		if($client_count == 0)
			header("Location: clients.php");
		
		while($client_row  = mysql_fetch_array($client_sql))
		{
			$client_id = $client_row['usr_id'];
			$client_first_name = $client_row['usr_first_name'];
			$client_last_name = $client_row['usr_last_name'];
			$client_email = $client_row['usr_email'];
			$client_mobile = $client_row['usr_mobile'];
			$client_date_added = $client_row['usr_date_added'];
			$client_status = $client_row['usr_status'];
			$client_type = $client_row['usr_type'];
			
			$client_date_added = date_create($client_date_added);
			$client_date_added = date_format($client_date_added,"d/m/Y");
			
			date_default_timezone_set("Africa/Cairo");
			
			if($client_status == 1)
			{
				$status_label = "Approved";
			}
			elseif($client_status == 0)
			{
				$status_label = "Pending";
			}
		}
				
	}

?>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
                <div class="box-header with-border">
                  <i class="fa fa-eye"></i> <h3 class="box-title">View Client</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="firstname" class="col-sm-2 control-label">First Name</label>
                      <div class="col-sm-10">
                        <label for="firstname" class="form-control"><?= $client_first_name ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="lastname" class="col-sm-2 control-label">Last Name</label>
                      <div class="col-sm-10">
                        <label for="lastname" class="form-control"><?= $client_last_name ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <label for="email" class="form-control"><?= $client_email ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="mobile" class="col-sm-2 control-label">Mobile</label>
                      <div class="col-sm-10">
                        <label for="mobile" class="form-control"><?= $client_mobile ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="dateadded" class="col-sm-2 control-label">Date Added</label>
                      <div class="col-sm-10">
                        <label for="dateadded" class="form-control"><?= $client_date_added ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <label for="status" class="form-control"><?= $status_label ?></label>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="clients.php"><button type="button" class="btn btn-default">Cancel</button></a>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
