<?php $page_title = "Team"; ?>
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
            <li><a href="team.php"><?= $page_title ?></a></li>
            <li class="active">Edit Team</li>
          </ol>
        </section>

<?php

	if(!isset($_GET['t']))
		header("Location: team.php");
	else
	{
		$team_member_id = $_GET['t'];
		
		include("config.php");

		if(isset($_POST['updateteam']))
		{
			
			$team_member_name = $_POST['teammembername']; 
			$team_member_position = $_POST['teammemberposition'];
			$team_member_linkedin = $_POST['teammemberlinkedin'];
			$team_member_biography = $_POST['teammemberbiography'];
			$sort_order = $_POST['sortorder'];
			$team_member_status = $_POST['teammemberstatus'];
			
			if(isset($_FILES["updateteammemberimage"]["name"]))
			{	
				$target_dir = "../img/team/";
				$team_member_image = $_FILES["updateteammemberimage"]["name"];
				
				$e = 0;
				
				$target_file = $target_dir . $team_member_image;
				
				$imageFileType = pathinfo($team_member_image,PATHINFO_EXTENSION);
				
				
				// Check if image file is a actual image or fake image
				
				$check = getimagesize($_FILES["updateteammemberimage"]["tmp_name"]);
				
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
				if ($_FILES["updateteammemberimage"]["size"] > 4000000) 
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
					if (move_uploaded_file($_FILES["updateteammemberimage"]["tmp_name"], $target_file)) 
					{			
						$e = 0;
						$s = 2;		
					} 
					else 
					{
						$e = 4;
					}
				}
			}
			else
				$team_member_image = NULL;
					
			$team_query = 
			"
				UPDATE team 
				SET tmm_name = '$team_member_name', tmm_position = '$team_member_position', tmm_linkedin = '$team_member_linkedin', tmm_biography = '$team_member_biography', tmm_sort_order = '$sort_order', tmm_status = '$team_member_status'
				
			";
			
			if(isset($s))
			{
				if($s == 2)
				{
					$team_query .= 
					"
						, tmm_image = '$team_member_image'
					";
				}
			}
			
			$team_query .= 
			"
				WHERE tmm_id = '$team_member_id'
			";
			
			$team_sql = mysql_query($team_query);
			
			if($team_sql)
			{
				$e = 0;
			}
			else
			{
				$e = 5;
			}
			
		}
		else
		{
			
			$team_query = 
					"
						SELECT *
						FROM team
						WHERE tmm_id = '$team_member_id'
						LIMIT 1
					";
			
			$team_sql = mysql_query($team_query);
			
			$team_count = mysql_num_rows($team_sql);	
			
			if($team_count == 0)
				header("Location: team.php");
			
			while($team_row  = mysql_fetch_array($team_sql))
			{
				$team_member_name = $team_row['tmm_name'];
				$team_member_position = $team_row['tmm_position'];
				$team_member_image = $team_row['tmm_image'];
				$team_member_linkedin = $team_row['tmm_linkedin'];
				$team_member_biography = $team_row['tmm_biography'];
				$sort_order = $team_row['tmm_sort_order'];
				$team_member_status = $team_row['tmm_status'];
					
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
				$notification_message = "Please select an image file";
			if($e == 2)
				$notification_message = "Image file should not exceed 2Mbs";
			if($e == 3)
				$notification_message = "Only JPG, JPEG, PNG and GIF files are allowed";
			if($e == 4)
				$notification_message = "Unable to upload image file";
			if($e == 5)
				$notification_message = "There was an error updating team member";	
		}
		elseif($e == 0)
		{
			header("location: team.php?s=2");
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
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Edit Team</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="careerform" action="<?= $_SERVER['PHP_SELF'];?>?t=<?= $team_member_id ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="teammemberimage" class="col-sm-2 control-label">Image</label>
                      <div class="col-sm-10">
                        <label for="updateteammemberimage">
                            <img id="teammemberimage" name="teammemberimage" src="../img/team/<?= $team_member_image ?>" height="200" alt="" style="cursor:pointer">
                            <input id="updateteammemberimage" name="updateteammemberimage" type="file" onchange="updateimage(this);" style="display: none" />
                        </label>

                      </div>
                    </div>
                    <div class="form-group">
                      <label for="teammembername" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="teammembername" placeholder="Name" value="<?= $team_member_name ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="teammemberposition" class="col-sm-2 control-label">Position</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="teammemberposition" placeholder="Position" value="<?= $team_member_position ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="teammemberbiography" class="col-sm-2 control-label">Biography</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="teammemberbiography" placeholder="Biography"><?= $team_member_biography ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="teammemberlinkedin" class="col-sm-2 control-label">Linkedin</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="teammemberlinkedin" placeholder="Linkedin" value="<?= $team_member_linkedin ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="sortorder" class="col-sm-2 control-label">Sort Order</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" name="sortorder" placeholder="sortorder" value="<?= $sort_order ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="teammemberstatus" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <select name="teammemberstatus" class="form-control">
                        	<option value="1">Featured</option>
                            <option value="0" <?php if ($team_member_status == 0) { ?> selected="selected" <?php } ?> >Non-featured</option>
                        </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="team.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right" name="updateteam">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>

<script src="dist/js/updateimage.js"></script>