<?php $page_title = "Careers"; ?>
<?php include ("includes/header.php");?>
<?php include ("includes/sidebar.php"); ?>


<?php

	if(isset($_POST['addcareer']))
	{

		$career_job_title = $_POST['jobtitle'];
		$career_job_description = $_POST['jobdescription'];
		
		$e = 0;
		
		
		include("config.php");
		
		$team_member_query = 
		"
			INSERT INTO career (crr_title, crr_description)
			VALUES ('$career_job_title', '$career_job_description')	
		";
		
		$team_member_sql = mysql_query($team_member_query);
		
		$team_member_id = mysql_insert_id();
		
		if($team_member_sql)
			$e = 0;
		else
			$e = 1;
		
				

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
            <li><a href="careers.php"><?= $page_title ?></a></li>
            <li class="active">Add Career</li>
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
				$notification_message = "There was an error adding career";	
		}
		elseif($e == 0)
		{
			header("location: careers.php?s=1");
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
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Add Career</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="careerform" action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="jobtitle" class="col-sm-2 control-label">Job Title</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="jobtitle" placeholder="Job Title">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="jobdescription" class="col-sm-2 control-label">Job Description</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="jobdescription" rows="3" placeholder="Job Description"></textarea>
                      </div>
                    </div>
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="careers.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right" name="addcareer">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
