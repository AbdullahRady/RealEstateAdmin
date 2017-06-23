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
            <li><a href="#">Users</a></li>
            <li class="active"><?= $page_title ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
<?php

	if(isset($_GET['s']))
	{
		$s = $_GET['s'];
	}
	
	if(isset($s))
	{
		$notification_title = "Success";
		
		if($s == 1)
		{
			$notification_message = "Client added successfully";				
		}
		elseif($s == 2)
		{
			$notification_message = "Client updated successfully";				
		}
		elseif($s == 3)
		{
			$notification_message = "Client deleted successfully";				
		}
			
		echo
		'
	  <div class="row">
		<div class="col-md-11">
				
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> '.$notification_title.'</h4>
				'.$notification_message.'
			</div>	
			
		</div>
	  </div>						
		';	
	}
	

	
?>        
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <i class="fa fa-list"></i> <h3 class="box-title">Client List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Date Added</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		
		include("config.php");
		
		$clients_query = 
				"
					SELECT *
					FROM user
					WHERE usr_type != 1					
					ORDER BY usr_id DESC
				";
		
		$clients_sql = mysql_query($clients_query);
		
		$clients_count = mysql_num_rows($clients_sql);

		while($clients_row  = mysql_fetch_array($clients_sql))
		{
			$client_id = $clients_row['usr_id'];
			$client_first_name = $clients_row['usr_first_name'];
			$client_last_name = $clients_row['usr_last_name'];
			$client_email = $clients_row['usr_email'];
			$client_mobile = $clients_row['usr_mobile'];
			$client_date_added = $clients_row['usr_date_added'];
			$client_status = $clients_row['usr_status'];
			$client_type = $clients_row['usr_type'];
			
			$client_date_added = date_create($client_date_added);
			$client_date_added = date_format($client_date_added,"d/m/Y");
			
			date_default_timezone_set("Africa/Cairo");
			
			if($client_type == 3)
			{
				$status_label = "Guest";
				$status_class = "label-default";
			}
			elseif($client_status == 1)
			{
				$status_label = "Approved";
				$status_class = "label-success";
			}
			elseif($client_status == 0)
			{
				$status_label = "Pending";
				$status_class = "label-warning";
			}
			
?>                     
                      <tr>
                        <td align="center"><input name="" type="checkbox" value=""></td>
                        <td>CL<?= $client_id ?></td>
                        <td><?= $client_first_name ?></td>
                        <td><?= $client_last_name ?></td>
                        <td><?= $client_email ?></td>
                        <td><?= $client_mobile ?></td>
                        <td><?= $client_date_added ?></td>
                        <td><span class="label <?= $status_class ?>"><?= $status_label ?></span></td>
                        <td align="center"> <a href="clientsview.php?c=<?= $client_id ?>"><button type="button" class="btn btn-info"><i class="fa fa-eye"></i></button></a> <a href="clientsedit.php?c=<?= $client_id ?>"><button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i></button></a> <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                      </tr>
<?php

		}

?>                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Date Added</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    
<?php include ("includes/footer.php"); ?>


    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
