<?php $page_title = "Team"; ?>
<?php include ("includes/header.php");?>
<?php include ("includes/sidebar.php"); ?>


<?php

	if(isset($_POST['addteam']))
	{

		$team_member_name = $_POST['teammembername'];
		$team_member_position = $_POST['teammemberposition']; 
		$team_member_biography = $_POST['teammemberbiography'];
		$team_member_linkedin = $_POST['teammemberlinkedin']; 
		$team_member_status = $_POST['teammemberstatus'];
		$sort_order = $_POST['sortorder'];
				
						
		$target_dir = "../img/team/";
		$team_member_image = $_FILES["teammemberimage"]["name"];
		
		$e = 0;
		
		$target_file = $target_dir . $team_member_image;
		
		$imageFileType = pathinfo($team_member_image,PATHINFO_EXTENSION);
		
		
		// Check if image file is a actual image or fake image
		
		$check = getimagesize($_FILES["teammemberimage"]["tmp_name"]);
		
		if($check == false) 
		{
			$e = 1;
		}
		
		// Check if file already exists
		if (file_exists($target_file)) 
		{
			$time = time();
			$team_member_image = "member$time.$imageFileType";
			$target_file = $target_dir . $team_member_image;
		}
		
		// Check file size
		if ($_FILES["teammemberimage"]["size"] > 4000000) 
		{
			$e = 2;
		}
		
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
		{
			$e = 3;
		}
		
		if($e == 0) 
		{
			if (move_uploaded_file($_FILES["teammemberimage"]["tmp_name"], $target_file)) 
			{
								
				if($sort_order == NULL)
					$sort_order = 0;
						
				include("config.php");
				
				$team_member_query = 
				"
					INSERT INTO team (tmm_name, tmm_position, tmm_image, tmm_linkedin, tmm_biography, tmm_sort_order, tmm_status)
					VALUES ('$team_member_name', '$team_member_position', '$team_member_image', '$team_member_linkedin', '$team_member_biography', '$sort_order', '$team_member_status')	
				";
				
				$team_member_sql = mysql_query($team_member_query);
				
				$team_member_id = mysql_insert_id();
				
				if($team_member_sql)
					$e = 0;
				else
					$e = 5;
						
			} 
			else 
			{
				$e = 4;
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
            <li><a href="team.php"><?= $page_title ?></a></li>
            <li class="active">Edit Team</li>
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
				$notification_message = "There was an error adding team member";	
		}
		elseif($e == 0)
		{
			header("location: team.php?s=1");
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
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Add Team</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="teamform" action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="teammemberimage" class="col-sm-2 control-label">Image</label>
                      <div class="col-sm-10">
                        <img name="" src="dist/img/user1-160x160.jpg" width="150" height="150" alt="">
                        
                        <input type="file" class="control-label" name="teammemberimage" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="teammembername" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="teammembername" placeholder="Name" value="<?php if(isset($team_member_name)) echo $team_member_name; ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="teammemberposition" class="col-sm-2 control-label">Position</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="teammemberposition" placeholder="Position" value="<?php if(isset($team_member_position)) echo $team_member_position; ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="biography" class="col-sm-2 control-label">Biography</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="teammemberbiography" rows="3" placeholder="Biography"><?php if(isset($team_member_biography)) echo $team_member_biography; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="teammemberlinkedin" class="col-sm-2 control-label">Linkedin</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="teammemberlinkedin" placeholder="Linkedin" value="<?php if(isset($team_member_linkedin)) echo $team_member_linkedin; ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="sortorder" class="col-sm-2 control-label">Sort Order</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" name="sortorder" placeholder="Sort order" value="<?php if(isset($sort_order)) echo $sort_order; ?>" step="10">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="teammemberstatus" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <select name="teammemberstatus" class="form-control">
                        	<option value="1">Featured</option>
                            <option value="0">Non-featured</option>
                        </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="team.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right" name="addteam">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>

<script>
	$("input[id='teammemberimage']").click(function() 
	{
		$("input[id='teammemberuploadimage']").click();
	}
	);
</script>