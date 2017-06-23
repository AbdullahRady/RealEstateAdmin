<?php $page_title = "Districts"; ?>
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
        	<a href="districtsadd.php"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Add new"><i class="fa fa-plus"></i></button></a>
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
			$notification_message = "District added successfully";				
		}
		elseif($s == 2)
		{
			$notification_message = "District updated successfully";				
		}
		elseif($s == 3)
		{
			$notification_message = "District deleted successfully";				
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
                  <i class="fa fa-list"></i> <h3 class="box-title">District List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>District Name</th>
                        <th>Sort Order</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		
		include("config.php");
		
		$districts_query = 
				"
					SELECT *
					FROM district					
					ORDER BY dst_id DESC
				";
		
		$districts_sql = mysql_query($districts_query);
		
		$districts_count = mysql_num_rows($districts_sql);

		while($districts_row  = mysql_fetch_array($districts_sql))
		{
			$district_id = $districts_row['dst_id'];
			$district_name = $districts_row['dst_name'];
			$sort_order = $districts_row['dst_sort_order'];
			
?>                    
                      <tr>
                        <td align="center"><input name="" type="checkbox" value=""></td>
                        <td><?= $district_name ?></td>
                        <td><?= $sort_order ?></td>
                        <td align="center"> <a href="districtsedit.php?d=<?= $district_id ?>"><button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i></button></a> <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                      </tr>
<?php

		}

?>                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th>District Name</th>
                        <th>Sort Order</th>
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
