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
            <li><a href="propertytypes.php"><?= $page_title ?></a></li>
            <li class="active">Edit Property Type</li>
          </ol>
        </section>

<?php

	if(!isset($_GET['p']))
		header("Location: propertytypes.php");
	else
	{
		$property_type_id = $_GET['p'];
		
		include("config.php");
		
		$property_type_query = 
				"
					SELECT *
					FROM property_type
					WHERE ptp_id = '$property_type_id'
					LIMIT 1
				";
		
		$property_type_sql = mysql_query($property_type_query);
		
		$property_type_count = mysql_num_rows($property_type_sql);	
		
		if($property_type_count == 0)
			header("Location: propertytypes.php");
		
		while($property_type_row  = mysql_fetch_array($property_type_sql))
		{
			$property_type_id = $property_type_row['ptp_id'];
			$property_type = $property_type_row['ptp_type'];
			$sort_order = $property_type_row['ptp_sort_order'];
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
				$notification_message = "There was an error updating property type";
		}
		else
		{
			header("location: propertytypes.php?s=2");
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
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Edit Property Type</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="propertytypeform" action="<?= $_SERVER['PHP_SELF'];?>?p=<?= $property_type_id ?>" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="propertytype" class="col-sm-2 control-label">Property Type</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="propertytype" placeholder="Property Type" value="<?= $property_type ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="sortorder" class="col-sm-2 control-label">Sort Order</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="sortorder" placeholder="Sort Order" value="<?= $sort_order ?>">
                      </div>
                    </div>
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="propertytypes.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right" name="updatepropertytype">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
