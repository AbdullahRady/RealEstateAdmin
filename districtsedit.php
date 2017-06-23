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
            <li><a href="districts.php"><?= $page_title ?></a></li>
            <li class="active">Edit District</li>
          </ol>
        </section>

<?php

	if(!isset($_GET['d']))
		header("Location: districts.php");
	else
	{
		$district_id = $_GET['d'];
		
		include("config.php");
		
		if(isset($_POST['updatedistrict']))
		{
			
			$district_name = $_POST['districtname'];
			$parent_district = $_POST['parentdistrict']; 
			$sort_order = $_POST['sortorder'];
					
			$district_query = 
			"
				UPDATE district 
				SET dst_name ='$district_name', dst_sort_order = '$sort_order'
			";
			
			if($parent_district != "")
			{
				$district_query .= 
				"
					, dst_main = '$parent_district'
				";
			}
			else
			{
				$district_query .= 
				"
					, dst_main = NULL
				";
			}
			
			$district_query .= 
			"
				WHERE dst_id = '$district_id'
			";
			
			$district_sql = mysql_query($district_query);
			
			if($district_sql)
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
			$district_query = 
					"
						SELECT *
						FROM district
						WHERE dst_id = '$district_id'
						LIMIT 1
					";
			
			$district_sql = mysql_query($district_query);
			
			$district_count = mysql_num_rows($district_sql);	
			
			if($district_count == 0)
				header("Location: districts.php");
			
			while($district_row  = mysql_fetch_array($district_sql))
			{
				$district_id = $district_row['dst_id'];
				$district_name = $district_row['dst_name'];
				$district_main = $district_row['dst_main'];
				$sort_order = $district_row['dst_sort_order'];
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
				$notification_message = "There was an error updating district";
		}
		else
		{
			header("location: districts.php?s=2");
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
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Edit District</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="districtform" action="<?= $_SERVER['PHP_SELF'];?>?d=<?= $district_id ?>" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="districtname" class="col-sm-2 control-label">District Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="districtname" placeholder="District Name" value="<?= $district_name ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="parentdistrict" class="col-sm-2 control-label">District Parent</label>
                      <div class="col-sm-10">
                        <select name="parentdistrict" id="parentdistrict" class="form-control">
                            <option value="">None</option>                   
                          
						<?php
                          
						  		$parent_district_query = 
								"
									SELECT *
									FROM district
									ORDER BY dst_sort_order
									
								";
						
								$parent_district_sql = mysql_query($parent_district_query);
								
								while($parent_district_row  = mysql_fetch_array($parent_district_sql))
								{
									$parent_district_id = $parent_district_row['dst_id'];
									$parent_district_name = $parent_district_row['dst_name'];
						?>
                            
                            		<option value="<?= $parent_district_id ?>"<?php if($parent_district_id == $district_main){ ?> selected <?php } ?> ><?= $parent_district_name ?></option>
                            
						<?php	
								
								}
							
						  
						 ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="sortorder" class="col-sm-2 control-label">Sort Order</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="sortorder" placeholder="Sort Order" value="<?= $sort_order ?>">
                      </div>
                    </div>
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="districts.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right" name="updatedistrict">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
