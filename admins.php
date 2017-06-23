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
			$notification_message = "Admin added successfully";				
		}
		elseif($s == 2)
		{
			$notification_message = "Admin updated successfully";				
		}
		elseif($s == 3)
		{
			$notification_message = "Admin deleted successfully";				
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
                  <i class="fa fa-list"></i> <h3 class="box-title">Admin List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		
		include("config.php");
		
		$admins_query = 
		"
			SELECT *
			FROM user
			WHERE usr_type = 1					
			ORDER BY usr_id DESC
		";
		
		$admins_sql = mysql_query($admins_query);
		
		$admins_count = mysql_num_rows($admins_sql);

		while($admins_row  = mysql_fetch_array($admins_sql))
		{
			$admin_id = $admins_row['usr_id'];
			$admin_first_name = $admins_row['usr_first_name'];
			$admin_last_name = $admins_row['usr_last_name'];
			$admin_email = $admins_row['usr_email'];
			$admin_mobile = $admins_row['usr_mobile'];
			
?>                    
                      <tr>
                        <td align="center"><input name="" type="checkbox" value=""></td>
                        <td><?= $admin_first_name ?></td>
                        <td><?= $admin_last_name ?></td>
                        <td><?= $admin_email ?></td>
                        <td><?= $admin_mobile ?></td>
                        <td align="center"> <a href="adminsview.php?a=<?= $admin_id ?>"><button type="button" class="btn btn-info"><i class="fa fa-eye"></i></button></a> <a href="adminsedit.php?a=<?= $admin_id ?>"><button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i></button></a> <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                      </tr>
<?php

		}

?>                       
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
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
