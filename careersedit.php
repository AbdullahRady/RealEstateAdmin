<?php $page_title = "Careers"; ?>
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
            <li><a href="careers.php"><?= $page_title ?></a></li>
            <li class="active">Edit Career</li>
          </ol>
        </section>

<?php

	if(!isset($_GET['c']))
		header("Location: careers.php");
	else
	{
		$career_id = $_GET['c'];
		
		include("config.php");

		if(isset($_POST['updatecareer']))
		{
			
			$career_title = $_POST['jobtitle']; 
			$career_description = $_POST['jobdescription'];
					
			$career_query = 
			"
				UPDATE career 
				SET crr_title ='$career_title', crr_description = '$career_description'
				WHERE crr_id = '$career_id'
			";
			$career_sql = mysql_query($career_query);
			
			if($career_sql)
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
			
			$career_query = 
			"
				SELECT *
				FROM career
				WHERE crr_id = '$career_id'
				LIMIT 1
			";
			
			$career_sql = mysql_query($career_query);
			
			$career_count = mysql_num_rows($career_sql);	
			
			if($career_count == 0)
				header("Location: careers.php");
			
			while($career_row  = mysql_fetch_array($career_sql))
			{
				$career_title = $career_row['crr_title'];
				$career_description = $career_row['crr_description'];
				$career_date_listed = $career_row['crr_date_listed'];
				$career_status = $career_row['crr_status'];
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
				$notification_message = "There was an error updating career";
		}
		else
		{
			header("location: careers.php?s=2");
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
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Edit Career</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="careerform" action="<?= $_SERVER['PHP_SELF'];?>?c=<?= $career_id ?>" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="jobtitle" class="col-sm-2 control-label">Job Title</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="jobtitle" placeholder="Job Title" value="<?= $career_title ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="jobdescription" class="col-sm-2 control-label">Job Description</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="jobdescription" rows="3" placeholder="Job Description" required><?= $career_description ?></textarea>
                      </div>
                    </div>
                    <!--
                    <div class="form-group">
                      <label for="jobtitle" class="col-sm-2 control-label">Date Listed</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="jobtitle" placeholder="Date Listed" value="<?= $career_date_listed ?>">
                      </div>
                    </div>
                    -->
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="careers.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right" name="updatecareer">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
