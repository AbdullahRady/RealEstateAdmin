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
            <li class="active">View Career</li>
          </ol>
        </section>

<?php

	if(!isset($_GET['c']))
		header("Location: careers.php");
	else
	{
		$career_id = $_GET['c'];
		
		include("config.php");
		
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
			$career_id = $career_row['crr_id'];
			$career_title = $career_row['crr_title'];
			$career_description = $career_row['crr_description'];
			$career_date_listed = $career_row['crr_date_listed'];
			$career_status = $career_row['crr_status'];
		}
				
	}

?>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
                <div class="box-header with-border">
                  <i class="fa fa-eye"></i> <h3 class="box-title">View Career</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="jobtitle" class="col-sm-2 control-label">Job Title</label>
                      <div class="col-sm-10">
                        <label for="jobtitle" class="form-control"><?= $career_title ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="jobdescription" class="col-sm-2 control-label">Job Description</label>
                      <div class="col-sm-10">
                        <label for="jobdescription" style="height:100%" class="form-control"><?= $career_description ?> &nbsp;</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="jobtitle" class="col-sm-2 control-label">Date Listed</label>
                      <div class="col-sm-10">
                        <label for="jobtitle" class="form-control"><?= $career_date_listed ?></label>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="careers.php"><button type="button" class="btn btn-default">Cancel</button></a>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
