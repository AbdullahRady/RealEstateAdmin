<?php $page_title = "Finishing"; ?>
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
            <li><a href="finishing.php"><?= $page_title ?></a></li>
            <li class="active">Edit Finishing</li>
          </ol>
        </section>

<?php

	if(!isset($_GET['f']))
		header("Location: finishing.php");
	else
	{
		$finishing_id = $_GET['f'];
		
		include("config.php");
		
		if(isset($_POST['updatefinishing']))
		{
			
			$finishing_option = $_POST['finishingoption']; 
			$sort_order = $_POST['sortorder'];
					
			$finishing_query = 
			"
				UPDATE finishing 
				SET fsh_option ='$finishing_option', fsh_sort_order = '$sort_order'
				WHERE fsh_id = '$finishing_id'
			";
			$finishing_sql = mysql_query($finishing_query);
			
			if($finishing_sql)
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
			$finishing_query = 
					"
						SELECT *
						FROM finishing
						WHERE fsh_id = '$finishing_id'
						LIMIT 1
					";
			
			$finishing_sql = mysql_query($finishing_query);
			
			$finishing_count = mysql_num_rows($finishing_sql);	
			
			if($finishing_count == 0)
				header("Location: finishing.php");
			
			while($finishing_row  = mysql_fetch_array($finishing_sql))
			{
				$finishing_id = $finishing_row['fsh_id'];
				$finishing_option = $finishing_row['fsh_option'];
				$sort_order = $finishing_row['fsh_sort_order'];
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
				$notification_message = "There was an error updating finishing option";
		}
		else
		{
			header("location: finishing.php?s=2");
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
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Edit Finishing</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="finishingform" action="<?= $_SERVER['PHP_SELF'];?>?f=<?= $finishing_id ?>" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="finishingoption" class="col-sm-2 control-label">Finishing Option</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="finishingoption" placeholder="Finishing Option" value="<?= $finishing_option ?>">
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
                    <a href="finishing.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right" name="updatefinishing">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
