<?php $page_title = "Properties"; ?>
<?php include ("includes/header.php");?>
<?php include ("includes/sidebar.php"); ?>


<?php
	
	if(!isset($_GET['p']))
		header("Location: properties.php");
	else
	{
		$property_id = $_GET['p'];
		
		include("config.php");
			
		$property_query = 
		"
			SELECT *
			FROM property
			WHERE prp_id = '$property_id'
			LIMIT 1
		";
		
		$property_sql = mysql_query($property_query);
		
		$property_count = mysql_num_rows($property_sql);	
		
		if($property_count == 0)
			header("Location: properties.php");
		
		while($property_row  = mysql_fetch_array($property_sql))
		{
			
			$property_title = $property_row['prp_title'];
			$property_type = $property_row['prp_type'];
			$property_district = $property_row['prp_district'];
			$property_for = $property_row['prp_for'];
			$property_delivery_date = $property_row['prp_delivery_date'];
			$property_finishing = $property_row['prp_finishing'];
			$property_payment = $property_row['prp_payment'];
			$property_elevator = $property_row['prp_elevator'];
			$property_in_compound = $property_row['prp_in_compound'];	
			//$property_floor = $property_row['prp_floor'];
			$property_bedrooms = $property_row['prp_bedrooms'];
			$property_bathrooms = $property_row['prp_bathrooms'];
			$property_balconys = $property_row['prp_balconys'];
			$property_area = $property_row['prp_area'];
			$property_price = $property_row['prp_price'];
			$property_description = $property_row['prp_description']; 
			$property_location = $property_row['prp_location'];
			$property_compound = $property_row['prp_project'];
			$property_status = $property_row['prp_status'];
		}
		
	}
	
		$property_type_query = 
		"
			SELECT *
			FROM property_type
			WHERE ptp_id = '$property_type'
		
		";
		
		$property_type_sql = mysql_query($property_type_query);
		
		while($property_type_row  = mysql_fetch_array($property_type_sql))
		{
			$type = $property_type_row['ptp_type']; 
		}	
		
		$district_query = 
		"
			SELECT *
			FROM district
			WHERE dst_id = '$property_district'
		
		";
		
		$district_sql = mysql_query($district_query);
		
		while($district_row  = mysql_fetch_array($district_sql))
		{
			$district_name = $district_row['dst_name'];
		}
		
		if($property_for == "r")
		{
			$for = "Rent";
		}
		else
		{
			$for = "Sale";
		}
		
		$delivery_query = 
		"
			SELECT *
			FROM delivery
			WHERE dlv_id = '$property_delivery_date'
		
		";
		
		$delivery_sql = mysql_query($delivery_query);
		
		while($delivery_row  = mysql_fetch_array($delivery_sql))
		{
			$delivery_date = $delivery_row['dlv_date']; 
		}
		
		$finishing_query = 
		"
			SELECT *
			FROM finishing
			WHERE fsh_id = '$property_finishing'
		
		";
		
		$finishing_sql = mysql_query($finishing_query);
		
		while($finishing_row  = mysql_fetch_array($finishing_sql))
		{
			$finishing_option = $finishing_row['fsh_option'];
		}		
		
		$payment_query = 
		"
			SELECT *
			FROM payment
			WHERE pmt_id = '$property_payment'
		
		";
		
		$payment_sql = mysql_query($payment_query);
		
		while($payment_row  = mysql_fetch_array($payment_sql))
		{
			$payment_option = $payment_row['pmt_option']; 
		}
		
		if($property_elevator == 0)
		{
			$elevator = "No";
		}
		else
		{
			$elevator = "Yes";
		}
		
		if($property_in_compound == 0)
		{
			$in_compound = "No";
		}
		else
		{
			$in_compound = "Yes";
		}
		
		if($property_in_compound == 1)
		{	
			$project_query = 
			"
				SELECT *
				FROM project
				WHERE prj_id = '$property_compound'
			
			";
			
			$project_sql = mysql_query($project_query);
			
			while($project_row  = mysql_fetch_array($project_sql))
			{
				$project_name = $project_row['prj_title'];
			}		
		}
		
		if($property_balconys == 0)
		{
			$balconys = "No";
		}
		else
		{
			$balconys = "Yes";
		}
		
		if($property_status == 0)
		{
			$status = "Pending";
		}
		elseif($property_status == 1)
		{
			$status = "Approved";
		}
		
		$property_images_query = 
		"
			SELECT *
			FROM property_image
			WHERE prp_id = '$property_id'
		";
		
		$property_images_sql = mysql_query($property_images_query);		
		$images_count = mysql_num_rows($property_images_sql);	
			
					
?>
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
            <li class="active">View Property</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
                <div class="box-header with-border">
                  <i class="fa fa-eye"></i> <h3 class="box-title">View Property</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="propertyform" action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">

<?php

	if($images_count >= 1)
	{
?>			
                <div align="center" style="margin: 25px 0px 25px 0px" class="col-md-12">
                 <div style="max-width: 750px; max-height:500px;">
                                      
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
<?php
		
		for($i=0;$i<$images_count;$i++)
		{
			$aclass = "";
			if($i == 0)			
				$aclass = "active";
			
			if($images_count> 1)
			{
		
?>                    
                      <li data-target="#carousel-example-generic" data-slide-to="<?= $i ?>" class="<?= $aclass ?>"></li>
<?php

			}
			
		}

?>                      
                    </ol>
                    <div class="carousel-inner">
<?php

		$i = 0;
		
		while($property_images_row  = mysql_fetch_array($property_images_sql))
		{
			$image_id = $property_images_row['img_id'];
			$image_name = $property_images_row['img_name'];
			$image_source = "../uploads/properties/$property_id/images/$image_name";
					
			$aclass = "";
			
			if($i == 0)			
				$aclass = "active";

?>                    
                      <div class="item <?= $aclass ?>">
                        <img src="<?= $image_source ?>" style="max-width:750px; max-height:500px;">
                        <div class="carousel-caption"> </div>
                      </div>
                      
<?php
		
			$i++;
		
		}

?>                      
                    </div>
<?php

		if($images_count > 1)
		{
?>                    
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
<?php

		}
?>                     
                  </div>
                 </div>
                </div>

<?php

	}

?>                    
                    <div class="form-group">
                      <label for="propertyid" class="col-sm-2 control-label">Property ID</label>
                      <div class="col-sm-10">
                        <label class="form-control">ES<?= $property_id ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertytitle" class="col-sm-2 control-label">Property Title</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $property_title ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertydescription" class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-10">
                        <label style="height:100%" class="form-control"><?= $property_description ?> &nbsp;</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertyprice" class="col-sm-2 control-label">Price</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $property_price ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertyarea" class="col-sm-2 control-label">Area</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $property_area ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertytype" class="col-sm-2 control-label">Property Type</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $type ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertydistrict" class="col-sm-2 control-label">District</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $district_name ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertyfor" class="col-sm-2 control-label">Property For</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $for ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertydeliverydate" class="col-sm-2 control-label">Delivery Date</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $delivery_date ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertyfinishing" class="col-sm-2 control-label">Finishing Options</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $finishing_option ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertypayment" class="col-sm-2 control-label">Payment Method</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $payment_option ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertyelevator" class="col-sm-2 control-label">Elevator</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $elevator ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertyincompound" class="col-sm-2 control-label">In A Compound</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $in_compound ?></label>
                      </div>
                    </div>
<?php

	if($property_in_compound == 1)
	{

?>                    
                    <div class="form-group">
                      <label for="propertycompound" class="col-sm-2 control-label">Compound Name</label>
                      <div class="col-sm-10">                        
                        <label class="form-control"><? if(isset ($project_name)) echo $project_name; else echo"Other"; ?></label>
                      </div>
                    </div>
<?php

	}

?>                    
                    <div class="form-group">
                      <label for="propertybedrooms" class="col-sm-2 control-label">Number Of Bedrooms</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $property_bedrooms ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertybathrooms" class="col-sm-2 control-label">Number Of Bathrooms</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $property_bathrooms ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertybalconys" class="col-sm-2 control-label">Balconys</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $balconys ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertylocation" class="col-sm-2 control-label">Location</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $property_location ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertystatus" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <label class="form-control"><?= $status ?></label>
                      </div>
                    </div>                 
                    
                  </div><!-- /.box-body -->
                  
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>

<script src="dist/js/updateimage.js"></script>

	<script>
            function incompound() 
            {
                var propertyincompound = document.getElementById("propertyincompound").value;
                
                if(propertyincompound == 1)
                {
                    document.getElementById("propertycompound").disabled = false;
                }
                else
                {
                    document.getElementById("propertycompound").disabled = true;
                }
            }
    </script>