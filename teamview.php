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
            <li class="active">View Team</li>
          </ol>
        </section>

<?php

	if(!isset($_GET['t']))
		header("Location: team.php");
	else
	{
		$team_member_id = $_GET['t'];
		
		include("config.php");
		
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
		}
				
	}

?>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
                <div class="box-header with-border">
                  <i class="fa fa-eye"></i> <h3 class="box-title">View Team</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="teammemberimage" class="col-sm-2 control-label">Image</label>
                      <div class="col-sm-10">
                        
                        <a href="#"><img name="" src="../img/team/<?= $team_member_image ?>" height="200" alt=""></a>
                        <!--
                        <input name="teammemberimage" id="teammemberimage" type="image" src="../img/team/<?= $team_member_image ?>" height="150">
                        <input type="file" id="teammemberuploadimage" style="display: none;" />
                        -->
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="teammembername" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-10">
                        <label for="teammembername" class="form-control"><?= $team_member_name ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="teammemberposition" class="col-sm-2 control-label">Position</label>
                      <div class="col-sm-10">
                        <label for="teammemberposition" class="form-control"><?= $team_member_position ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="biography" class="col-sm-2 control-label">Biography</label>
                      <div class="col-sm-10">
                        <label for="biography" style="height:100%" class="form-control"><?= $team_member_biography ?> &nbsp;</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="teammemberlinkedin" class="col-sm-2 control-label">Linkedin</label>
                      <div class="col-sm-10">
                        <label for="teammemberlinkedin" class="form-control"><?= $team_member_linkedin ?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="sortorder" class="col-sm-2 control-label">Sort Order</label>
                      <div class="col-sm-10">
                        <label for="sortorder" class="form-control"><?= $sort_order ?></label>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="team.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right">Save</button>
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