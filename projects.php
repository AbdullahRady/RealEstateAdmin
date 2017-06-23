<?php $page_title = "Projects"; ?>
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
			$notification_message = "Project added successfully";				
		}
		elseif($s == 2)
		{
			$notification_message = "Project updated successfully";				
		}
		elseif($s == 3)
		{
			$notification_message = "Project deleted successfully";				
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
                  <i class="fa fa-list"></i> <h3 class="box-title">Project List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Project Title</th>
                        <th>Developer</th>
                        <th>Delivery Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		
		include("config.php");
		
		$projects_query = 
				"
					SELECT *
					FROM project					
					ORDER BY prj_id DESC
				";
		
		$projects_sql = mysql_query($projects_query);
		
		$projects_count = mysql_num_rows($projects_sql);

		while($projects_row  = mysql_fetch_array($projects_sql))
		{
			$project_id = $projects_row['prj_id'];
			$project_title = $projects_row['prj_title'];
			$project_developer = $projects_row['prj_developer'];
			$project_delivery_date = $projects_row['prj_delivery_date'];
			
			$project_image_query = 
			"
				SELECT img_name
				FROM project_image
				WHERE prj_id = '$project_id'
				LIMIT 1
			";
			
			$project_image_sql = mysql_query($project_image_query);
			
			$project_image_row = mysql_fetch_array($project_image_sql);
			
				$project_image = $project_image_row[0];
			
			$project_image_count = mysql_num_rows($project_image_sql);
			
			if($project_image_count == 0)
				$image_source = "../img/property-placeholder-228x128.jpg";			
			else
				$image_source = "../uploads/projects/$project_id/images/$project_image";

?>                    
                      <tr>
                        <td align="center"><input name="" type="checkbox" value=""></td>
                        <td>PJ<?= $project_id ?></td>
                        <td><img src="<?= $image_source ?>" width="120" height="70" alt=""></td>
                        <td><?= $project_title ?></td>
                        <td><?= $project_developer ?></td>
                        <td><?= $project_delivery_date ?></td>
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
                        <th>Project Title</th>
                        <th>Developer</th>
                        <th>Delivery Date</th>
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
