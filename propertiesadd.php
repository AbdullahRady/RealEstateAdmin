<?php $page_title = "Properties"; ?>
<?php include ("includes/header.php");?>
<?php include ("includes/sidebar.php"); ?>


<?php

	if(isset($_POST['addproperty']))
	{
		$property_title = $_POST['propertytitle'];
		$property_type = $_POST['propertytype'];
		$property_district = $_POST['propertydistrict'];
		$property_for = $_POST['propertyfor'];
		$property_delivery_date = $_POST['propertydeliverydate'];
		$property_finishing = $_POST['propertyfinishing'];
		$property_payment = $_POST['propertypayment'];
		$property_elevator = $_POST['propertyelevator'];
		$property_in_compound = $_POST['propertyincompound'];	
		//$property_floor = $_POST['propertyfloor'];
		$property_bedrooms = $_POST['propertybedrooms'];
		$property_bathrooms = $_POST['propertybathrooms'];
		$property_balconys = $_POST['propertybalconys'];
		$property_area = $_POST['propertyarea'];
		$property_price = $_POST['propertyprice'];
		$property_description = $_POST['propertydescription'];
		
		
		if(isset($_POST['propertylocation'])) 
			$property_location = $_POST['propertylocation'];
		else		
			$property_location = NULL;
			
		if($property_in_compound == 1 && isset($_POST['propertycompound']) && $_POST['propertycompound'] != NULL)
			$property_compound = $_POST['propertycompound'];
		
		
		
		$add_property_query = 
		" 
			INSERT INTO property (prp_title, prp_location, prp_description, prp_type, prp_district, prp_for, prp_delivery_date, prp_finishing, prp_payment, prp_area, prp_price, prp_in_compound, prp_bedrooms, prp_bathrooms, prp_elevator, prp_balconys, prp_user, prp_status, prp_admin
		";
		
		if(isset($property_compound))
		{
			$add_property_query .=
			"
				, prp_project
			";
		}
		
		$add_property_query .=
		"
			)
			VALUES ('$property_title', '$property_location', '$property_description', '$property_type', '$property_district', '$property_for', '$property_delivery_date', '$property_finishing', '$property_payment', '$property_area', '$property_price', '$property_in_compound', '$property_bedrooms', '$property_bathrooms', '$property_elevator', '$property_balconys', '$admin_id', '1', '$admin_id'
		";
		
		if(isset($property_compound))
		{			
			$add_property_query .=
			"
				, '$property_compound'
			";
		}
		
		$add_property_query .=
		"
			)
		";
		
		$add_property = mysql_query($add_property_query);	
		
		if($add_property)
			$e = 0;
		else
			$e = 5;	
		
		$property_id = mysql_insert_id();
		
		
		$target_dir = "../uploads/properties/$property_id/images/";
		$caption = "property";
		
		
		if( !file_exists($target_dir) ) 
			mkdir($target_dir,0777,true);
		
		if(isset($_FILES['files']['tmp_name']))
		{
			foreach($_FILES['files']['tmp_name'] as $key => $tmp_name )
			{		
				$file_name = $_FILES['files']['name'][$key];
				$file_size =$_FILES['files']['size'][$key];
				$file_tmp =$_FILES['files']['tmp_name'][$key];
				$file_type=$_FILES['files']['type'][$key];
							
				$target_file = $target_dir . $file_name;
				
							
				//verify if the uploaded file is allowed or not
								
				$allowed =  array('jpeg','jpg','gif','png');
				
				$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
				$file_ext = strtolower($file_ext);
				  
				if(in_array($file_ext,$allowed))
				{
					//$e = 1;
				}
				
				
				//limit the upload file size
				if($file_size > 2097152)
				{
					$e = 2;
				}
				
				// Check if file already exists
				if (file_exists($target_file)) 
				{
					$time = time();
					$file_name = "$caption$time.$file_ext";
					$target_file = $target_dir.$file_name;
				}
				
				if(empty($e)==true)
				{
					$move_file = move_uploaded_file($file_tmp, $target_file);
					
					if($move_file)
					{
						include("config.php");
						
						$add_property_image_query = 
						" 
							INSERT INTO property_image (prp_id, img_name)
							 
							VALUES ('$property_id', '$file_name') 
						";
						
						$add_property_image = mysql_query($add_property_image_query) or die(mysql_error());	
						
						$image_id = mysql_insert_id();
						
						if($add_property_image)
							$e = 0;
						else
							$e = 5;					
					}
					
				}
	
			
			}	
		}
		
					
	}
					
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
            <li class="active">Add Property</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
<?php

	if(isset($e))
	{
		if($e != 0)
		{
			$notification_title = "Failed";
			
			if($e == 1)
				$notification_message = "Please select an image file";
			if($e == 2)
				$notification_message = "Image file should not exceed 2Mbs";
			if($e == 3)
				$notification_message = "Only JPG, JPEG, PNG and GIF files are allowed";
			if($e == 4)
				$notification_message = "Unable to upload image file";
			if($e == 5)
				$notification_message = "There was an error adding property";	
		}
		elseif($e == 0)
		{
			header("location: properties.php?s=1");
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
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Add Property</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="propertyform" action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="propertytitle" class="col-sm-2 control-label">Property Title</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="propertytitle" placeholder="Property Title" value="<?php if(isset($property_title)) echo $property_title; ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertydescription" class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="propertydescription" placeholder="Description" required><?php if(isset($property_description)) echo $property_description; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertyprice" class="col-sm-2 control-label">Price</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" name="propertyprice" placeholder="Price" value="<?php if(isset($property_price)) echo $property_price; ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertyarea" class="col-sm-2 control-label">Area</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" name="propertyarea" placeholder="Area" value="<?php if(isset($property_area)) echo $property_area; ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertytype" class="col-sm-2 control-label">Property Type</label>
                      <div class="col-sm-10">
                        <select name="propertytype" id="propertytype" class="form-control">
<?php 

		include("config.php");
		
		$property_type_query = 
		"
			SELECT *
			FROM property_type
			ORDER BY ptp_sort_order
		
		";
		
		$property_type_sql = mysql_query($property_type_query);
		
		while($property_type_row  = mysql_fetch_array($property_type_sql))
		{
			$type_id = $property_type_row['ptp_id'];
			$type = $property_type_row['ptp_type'];
?>                             
                                <option value="<?= $type_id ?>" <?php if(isset($property_type)) if($property_type == $type_id) { ?> selected <?php } ?> ><?= $type ?></option>
<?php 
		}
?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertydistrict" class="col-sm-2 control-label">District</label>
                      <div class="col-sm-10">
                        <select name="propertydistrict" id="propertydistrict" class="form-control">
<?php 
		
		$district_query = 
		"
			SELECT *
			FROM district
			ORDER BY dst_sort_order
		
		";
		
		$district_sql = mysql_query($district_query);
		
		while($district_row  = mysql_fetch_array($district_sql))
		{
			$district_id = $district_row['dst_id'];
			$district_name = $district_row['dst_name'];
?>                             
                                <option value="<?= $district_id ?>" <?php if(isset($property_district)) if($property_district == $district_id) { ?> selected <?php } ?> ><?= $district_name ?></option>
<?php 
		}
?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertyfor" class="col-sm-2 control-label">Property For</label>
                      <div class="col-sm-10">
                        <select name="propertyfor" id="propertyfor" class="form-control">
                          <option value="s" <?php if(isset($property_for)) if($property_for == "s") { ?> selected <?php } ?> >Sale</option>
                          <option value="r" <?php if(isset($property_for)) if($property_for == "r") { ?> selected <?php } ?> >Rent</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertydeliverydate" class="col-sm-2 control-label">Delivery Date</label>
                      <div class="col-sm-10">
                        <select name="propertydeliverydate" id="propertydeliverydate" class="form-control">
<?php 

		$delivery_query = 
		"
			SELECT *
			FROM delivery
			ORDER BY dlv_sort_order
		
		";
		
		$delivery_sql = mysql_query($delivery_query);
		
		while($delivery_row  = mysql_fetch_array($delivery_sql))
		{
			$delivery_id = $delivery_row['dlv_id'];
			$delivery_date = $delivery_row['dlv_date'];
?>                             
                                <option value="<?= $delivery_id ?>" <?php if(isset($property_delivery_date)) if($property_delivery_date == $delivery_id) { ?> selected <?php } ?> ><?= $delivery_date ?></option>
<?php 
		}
?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertyfinishing" class="col-sm-2 control-label">Finishing Options</label>
                      <div class="col-sm-10">
                        <select name="propertyfinishing" id="propertyfinishing" class="form-control">
<?php 

		$finishing_query = 
		"
			SELECT *
			FROM finishing
			ORDER BY fsh_sort_order
		
		";
		
		$finishing_sql = mysql_query($finishing_query);
		
		while($finishing_row  = mysql_fetch_array($finishing_sql))
		{
			$finishing_id = $finishing_row['fsh_id'];
			$finishing_option = $finishing_row['fsh_option'];
?>                             
                                <option value="<?= $finishing_id ?>" <?php if(isset($property_finishing)) if($property_finishing == $finishing_id) { ?> selected <?php } ?> ><?= $finishing_option ?></option>
<?php 
		}
?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertypayment" class="col-sm-2 control-label">Payment Method</label>
                      <div class="col-sm-10">
                        <select name="propertypayment" id="propertypayment" class="form-control">
<?php 

		$payment_query = 
		"
			SELECT *
			FROM payment
			ORDER BY pmt_sort_order
		
		";
		
		$payment_sql = mysql_query($payment_query);
		
		while($payment_row  = mysql_fetch_array($payment_sql))
		{
			$payment_id = $payment_row['pmt_id'];
			$payment_option = $payment_row['pmt_option'];
?>                             
                                <option value="<?= $payment_id ?>" <?php if(isset($property_payment)) if($property_payment == $payment_id) { ?> selected <?php } ?> ><?= $payment_option ?></option>
<?php 
		}
?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertyelevator" class="col-sm-2 control-label">Elevator</label>
                      <div class="col-sm-10">
                        <select name="propertyelevator" id="propertyelevator" class="form-control">
                          <option value="0" <?php if(isset($property_elevator)) if($property_elevator == 0) { ?> selected <?php } ?> >No</option>
                          <option value="1" <?php if(isset($property_elevator)) if($property_elevator == 1) { ?> selected <?php } ?> >Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertyincompound" class="col-sm-2 control-label">In A Compound</label>
                      <div class="col-sm-10">
                        <select name="propertyincompound" id="propertyincompound" class="form-control" onchange="incompound()">
                          <option value="0" <?php if(isset($property_in_compound)) if($property_in_compound == 0) { ?> selected <?php } ?> >No</option>
                          <option value="1" <?php if(isset($property_in_compound)) if($property_in_compound == 1) { ?> selected <?php } ?> >Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertycompound" class="col-sm-2 control-label">Compound Name</label>
                      <div class="col-sm-10">
                        <select name="propertycompound" id="propertycompound" class="form-control" <?php if(!isset($property_in_compound) || (isset($property_in_compound) && $property_in_compound == 0) ) { ?> disabled <?php } ?> >
                        
<?php 

		include("config.php");
		
		$project_query = 
		"
			SELECT *
			FROM project
			ORDER BY prj_title
		
		";
		
		$project_sql = mysql_query($project_query);
		
		while($project_row  = mysql_fetch_array($project_sql))
		{
			$project_id = $project_row['prj_id'];
			$project_name = $project_row['prj_title'];
?>                             
                                <option value="<?= $project_id ?>" <?php if(isset($property_compound)) if($property_compound == $project_id) { $compound_selected = "1"; ?> selected <?php } ?> ><?= $project_name ?></option>
<?php 
		}
?>
                                <option value="" <?php if(!isset($compound_selected)) { ?> selected <?php } ?> >Other</option>                        
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertybedrooms" class="col-sm-2 control-label">Number Of Bedrooms</label>
                      <div class="col-sm-10">
                        <select name="propertybedrooms" id="propertybedrooms" class="form-control">
                          <option value="1" <?php if(isset($property_bedrooms)) if($property_bedrooms == 1) { ?> selected <?php } ?> >1</option>
                          <option value="2" <?php if(isset($property_bedrooms)) if($property_bedrooms == 2) { ?> selected <?php } ?> >2</option>
                          <option value="3" <?php if(isset($property_bedrooms)) if($property_bedrooms == 3) { ?> selected <?php } ?> >3</option>
                          <option value="4" <?php if(isset($property_bedrooms)) if($property_bedrooms == 4) { ?> selected <?php } ?> >4</option>
                          <option value="5" <?php if(isset($property_bedrooms)) if($property_bedrooms == 5) { ?> selected <?php } ?> >5</option>
                          <option value="9" <?php if(isset($property_bedrooms)) if($property_bedrooms == 9) { ?> selected <?php } ?> >More than 5</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertybathrooms" class="col-sm-2 control-label">Number Of Bathrooms</label>
                      <div class="col-sm-10">
                        <select name="propertybathrooms" id="propertybathrooms" class="form-control">
                          <option value="1" <?php if(isset($property_bathrooms)) if($property_bathrooms == 1) { ?> selected <?php } ?> >1</option>
                          <option value="2" <?php if(isset($property_bathrooms)) if($property_bathrooms == 2) { ?> selected <?php } ?> >2</option>
                          <option value="3" <?php if(isset($property_bathrooms)) if($property_bathrooms == 3) { ?> selected <?php } ?> >3</option>
                          <option value="4" <?php if(isset($property_bathrooms)) if($property_bathrooms == 4) { ?> selected <?php } ?> >4</option>
                          <option value="9" <?php if(isset($property_bathrooms)) if($property_bathrooms == 9) { ?> selected <?php } ?> >More than 4</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertybalconys" class="col-sm-2 control-label">Balconys</label>
                      <div class="col-sm-10">
                        <select name="propertybalconys" id="propertybalconys" class="form-control">
                          <option value="0" <?php if(isset($property_balconys)) if($property_balconys == 0) { ?> selected <?php } ?> >No</option>
                          <option value="1" <?php if(isset($property_balconys)) if($property_balconys == 1) { ?> selected <?php } ?> >Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="propertylocation" class="col-sm-2 control-label">Location</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="propertylocation" placeholder="Location" value="<?php if(isset($property_location)) echo $property_location; ?>" required>
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="propertyimages" class="col-sm-2 control-label">Upload Image</label>
                         <div class="col-sm-7">
                         
						<?php

							for($i=1; $i<=10; $i++)
							{

						?>                         
                         	<label for="updatepropertyimage<?= $i ?>">
                   	    		<img id="propertyimage<?= $i ?>" src="dist/img/add_image_palceholder.png" width="100" height="100" class="upload-image">
                                <input type="file" name="files[]" id="updatepropertyimage<?= $i ?>" style="display: none" onchange="updateimage(this);"/>
                            </label>
                            
						<?php

							}
						
						?>                                                         
                         </div>
                    </div>                 
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="properties.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right" name="addproperty">Save</button>
                  </div><!-- /.box-footer -->
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