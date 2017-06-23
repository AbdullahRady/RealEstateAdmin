<?php $page_title = "Careers"; ?>
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
            <li class="active"><?= $page_title ?></li>
          </ol>
        </section>
		
        <div class="col-xs-1 addpage">
        	<a href="careersadd.php"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Add new"><i class="fa fa-plus"></i></button></a>
        </div>
        
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
			$notification_message = "Career added successfully";				
		}
		elseif($s == 2)
		{
			$notification_message = "Career updated successfully";				
		}
		elseif($s == 3)
		{
			$notification_message = "Career deleted successfully";				
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
                  <i class="fa fa-list"></i> <h3 class="box-title">Career List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Job Title</th>
                        <th>Date Added</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		
		include("config.php");
		
		$careers_query = 
				"
					SELECT *
					FROM career					
					ORDER BY crr_id DESC
				";
		
		$careers_sql = mysql_query($careers_query);
		
		$careers_count = mysql_num_rows($careers_sql);

		while($careers_row  = mysql_fetch_array($careers_sql))
		{
			$career_id = $careers_row['crr_id'];
			$career_title = $careers_row['crr_title'];
			$career_listing_date = $careers_row['crr_date_listed'];
			
			
			$career_listing_date = date_create($career_listing_date);
			$career_listing_date = date_format($career_listing_date,"d/m/Y");
			
			date_default_timezone_set("Africa/Cairo");
			
?>                    
                      <tr>
                        <td align="center"><input name="" type="checkbox" value=""></td>
                        <td><?= $career_title ?></td>
                        <td><?= $career_listing_date ?></td>
                        <td align="center"> <a href="careersview.php?c=<?= $career_id ?>"><button type="button" class="btn btn-info"><i class="fa fa-eye"></i></button></a> <a href="careersedit.php?c=<?= $career_id ?>"><button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i></button></a> <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                      </tr>
<?php

		}

?>                       
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th>Job Title</th>
                        <th>Date Added</th>
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
