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
            <li class="active">Edit Client</li>
          </ol>
        </section>

<?php

	if(!isset($_GET['c']))
		header("Location: clients.php");
	else
	{
		$client_id = $_GET['c'];
		
		include("config.php");
		
		if(isset($_POST['updateclient']))
		{
			
			$client_first_name = $_POST['firstname']; 
			$client_last_name = $_POST['lastname'];
			$client_email = $_POST['email'];
			$client_mobile = $_POST['mobile'];
			$client_status = $_POST['status'];
					
			$client_query = 
			"
				UPDATE user 
				SET usr_first_name ='$client_first_name', usr_last_name = '$client_last_name', usr_email = '$client_email', usr_mobile = '$client_mobile', usr_status = '$client_status'  
				WHERE usr_type != 1 
				AND usr_id = '$client_id'
			";
			$client_sql = mysql_query($client_query);
			
			if($client_sql)
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
				$notification_message = "There was an error updating client";
		}
		else
		{
			header("location: clients.php?s=2");
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
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Edit Client</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="clientform" action="<?= $_SERVER['PHP_SELF'];?>?c=<?= $client_id ?>" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="firstname" class="col-sm-2 control-label">First Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?= $client_first_name ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="lastname" class="col-sm-2 control-label">Last Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?= $client_last_name ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $client_email ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="mobile" class="col-sm-2 control-label">Mobile</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" name="mobile" placeholder="Mobile" value="<?= $client_mobile ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="dateadded" class="col-sm-2 control-label">Date Added</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="dateadded" placeholder="Date Added" value="<?= $client_date_added ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <select name="status" id="status" class="form-control">
                          <?php
                          
						  		$status_query = 
								"
									SELECT *
									FROM status
									WHERE (sts_id = '0' || sts_id = '1')
									
								";
						
								$status_sql = mysql_query($status_query);
								
								while($status_row  = mysql_fetch_array($status_sql))
								{
									$status_id = $status_row['sts_id'];
									$status_label = $status_row['sts_label'];
							?>
                            
                            		<option value="<?= $status_id ?>" <?php if($client_status == $status_id){ ?> selected <?php } ?> ><?= $status_label ?></option>
                            
                            <?php	
								
								}
							
						  
						  ?>
                        </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="clients.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right" name="updateclient">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
