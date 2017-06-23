<?php $page_title = "Property Types"; ?>
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
            <li><a href="properties.php">Properties</a></li>
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
			$notification_message = "Property type added successfully";				
		}
		elseif($s == 2)
		{
			$notification_message = "Property type updated successfully";				
		}
		elseif($s == 3)
		{
			$notification_message = "Property type deleted successfully";				
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
                  <i class="fa fa-list"></i> <h3 class="box-title">Property Type List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Property Type</th>
                        <th>Sort Order</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		
		include("config.php");
		
		$property_types_query = 
				"
					SELECT *
					FROM property_type					
					ORDER BY ptp_id DESC
				";
		
		$property_types_sql = mysql_query($property_types_query);
		
		$property_types_count = mysql_num_rows($property_types_sql);

		while($property_types_row  = mysql_fetch_array($property_types_sql))
		{
			$property_type_id = $property_types_row['ptp_id'];
			$property_type = $property_types_row['ptp_type'];
			
?>			                    
                      <tr>
                        <td align="center"><input name="" type="checkbox" value=""></td>
                        <td><?= $property_type ?></td>
                        <td>0</td>
                        <td align="center"> <a href="propertytypesedit.php?p=<?= $property_type_id ?>"><button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i></button></a> <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                      </tr>
<?php

		}

?>                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th>Property Type</th>
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
