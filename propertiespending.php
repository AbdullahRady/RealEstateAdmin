<?php $page_title = "Properties"; ?>
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
            <li><a href="properties.php"><?= $page_title ?></a></li>
            <li class="active">Pending Properties</li>
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
			$notification_message = "Property approved successfully";				
		}
		elseif($s == 2)
		{
			$notification_message = "Property updated successfully";				
		}
		elseif($s == 3)
		{
			$notification_message = "Property deleted successfully";				
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
                  <i class="fa fa-list"></i> <h3 class="box-title">Pending Property List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Property Title</th>
                        <th>Price</th>
                        <th>User</th>
                        <th>Date Added</th>
                        <th>Status</th>
                        <th width="100">Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		
		include("config.php");
		
		$properties_query = 
				"
					SELECT *
					FROM property	
					WHERE prp_status = '0'				
					ORDER BY prp_id DESC
				";
		
		$properties_sql = mysql_query($properties_query);
		
		$properties_count = mysql_num_rows($properties_sql);

		while($properties_row  = mysql_fetch_array($properties_sql))
		{
			$property_id = $properties_row['prp_id'];
			$property_title = $properties_row['prp_title'];
			$property_price = $properties_row['prp_price'];
			$property_district = $properties_row['prp_district'];
			$property_listing_date = $properties_row['prp_listing_date'];
			$property_status = $properties_row['prp_status'];
			$property_user = $properties_row['prp_user'];
			
			$property_listing_date = date_create($property_listing_date);
			$property_listing_date = date_format($property_listing_date,"d/m/Y");
			
			date_default_timezone_set("Africa/Cairo");
			
			$property_price = number_format($property_price);
			
			if($property_status == 1)
			{
				$status_label = "Approved";
				$status_class = "label-success";
			}
			elseif($property_status == 0)
			{
				$status_label = "Pending";
				$status_class = "label-warning";
			}

			$property_district_query = 
			"
				SELECT dst_name
				FROM district
				WHERE dst_id = '$property_district'
				LIMIT 1
			";
			
			$property_district_sql = mysql_query($property_district_query);
			
			$property_district_row = mysql_fetch_array($property_district_sql);
			
				$property_district = $property_district_row[0];
				
			
			$property_user_query = 
			"
				SELECT usr_first_name, usr_last_name
				FROM user
				WHERE usr_id = '$property_user'
				LIMIT 1
			";
			
			$property_user_sql = mysql_query($property_user_query);
			
			$property_user_row = mysql_fetch_array($property_user_sql);
			
				$property_user_first_name = $property_user_row[0];
				$property_user_last_name = $property_user_row[1];
				$property_user = "$property_user_first_name $property_user_last_name";
				
			$property_image_query = 
			"
				SELECT img_name
				FROM property_image
				WHERE prp_id = '$property_id'
				LIMIT 1
			";
			
			$property_image_sql = mysql_query($property_image_query);
			
			$property_image_row = mysql_fetch_array($property_image_sql);
			
				$property_image = $property_image_row[0];
			
			$property_image_count = mysql_num_rows($property_image_sql);
			
			if($property_image_count == 0)
				$image_source = "../img/property-placeholder-228x128.jpg";			
			else
				$image_source = "../uploads/properties/$property_id/images/$property_image";	
?>                    
                      <tr>
                        <td align="center"><input name="" type="checkbox" value=""></td>
                        <td>ES<?= $property_id ?></td>
                        <td><img src="<?= $image_source ?>" width="120" height="70" alt=""></td>
                        <td><?= $property_title ?></td>
                        <td><?= $property_price ?> L.E.</td>
                        <td><?= $property_user ?></td>
                        <td><?= $property_listing_date ?></td>
                        <td><span class="label <?= $status_class ?>"><?= $status_label ?></span></td>
                        <td align="center" style="min-width:125px"><button type="button" class="btn btn-info"><i class="fa fa-eye"></i></button> <button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                      </tr>
<?php
			
		}

?>                     
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Property Title</th>
                        <th>Price</th>
                        <th>User</th>
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
