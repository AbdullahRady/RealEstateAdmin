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
            <li class="active"><?= $page_title ?></li>
          </ol>
        </section>

		<div class="col-xs-1 addpage">
        	<a href="teamadd.php"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Add new"><i class="fa fa-plus"></i></button></a>
        </div>

        <!-- Main content -->
        <section class="content">
<?php

	if(isset($_POST['deleteteammember']))
	{
		$team_member_id = $_POST['itemid'];	
		
		include("config.php");
									
		$team_query = 
		"
			UPDATE team 
			SET tmm_status = 9
			WHERE tmm_id = '$team_member_id'
		";
		
		$team_sql = mysql_query($team_query);
		
		if($team_sql)
		{
			$s = 3;
		}
		else
		{
			$e = 3;
		}
	}

	if(isset($_GET['s']))
	{
		$s = $_GET['s'];
	}
	
	if(isset($s))
	{
		$notification_title = "Success";
		
		if($s == 1)
		{
			$notification_message = "Team member added successfully";				
		}
		elseif($s == 2)
		{
			$notification_message = "Team member updated successfully";				
		}
		elseif($s == 3)
		{
			$notification_message = "Team member deleted successfully";				
		}
			
		echo
		'
	  <div class="row">
		<div class="col-md-11">
				
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> '.$notification_title.'</h4>
				'.$notification_message.'
			</div>	
			
		</div>
	  </div>						
		';	
	}
	

	
?> 
		       
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <i class="fa fa-list"></i> <h3 class="box-title">Team List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Sort Order</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		
		include("config.php");
		
		$team_query = 
				"
					SELECT *
					FROM team	
					WHERE tmm_status != 9				
					ORDER BY tmm_id DESC
				";
		
		$team_sql = mysql_query($team_query);
		
		$team_count = mysql_num_rows($team_sql);

		while($team_row  = mysql_fetch_array($team_sql))
		{
			$team_member_id = $team_row['tmm_id'];
			$team_member_image = $team_row['tmm_image'];
			$team_member_name = $team_row['tmm_name'];
			$team_member_position = $team_row['tmm_position'];
			$sort_order = $team_row['tmm_sort_order'];
			
?>                    
                      <tr>
                        <td align="center"><input name="" type="checkbox" value=""></td>
                        <td><img name="" src="../img/team/<?= $team_member_image ?>" width="70" height="70" alt=""></td>
                        <td><?= $team_member_name ?></td>
                        <td><?= $team_member_position ?></td>
                        <td><?= $sort_order ?></td>
                        <td align="center"> <a href="teamview.php?t=<?= $team_member_id ?>"><button type="button" class="btn btn-info"><i class="fa fa-eye"></i></button></a> <a href="teamedit.php?t=<?= $team_member_id ?>"><button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i></button></a> <button type="button" class="btn btn-danger" data-toggle="modal"  data-target="#DeleteModal" data-subjectid="<?= $team_member_id ?>" data-subject="<?= $team_member_name ?>"><i class="fa fa-trash"></i></button></td>
                      </tr>
<?php

		}

?>                       
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Sort Order</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header btn-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"><i class="icon fa fa-warning"></i> Warning</h4>
      </div>
      <div class="modal-body">
		Are you sure you want to delete team member <label class="modal-object"></label>?
      </div>
      <div class="modal-footer">
      	<form name="deleteteammemberform" action="<?= $_SERVER['PHP_SELF'];?>" method="post">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input id="itemid" name="itemid" type="hidden" value=""/>
        	<button type="submit" class="btn btn-primary" name="deleteteammember">Delete</button>
        </form>    
      </div>
    </div>
  </div>
</div>
    
<?php include ("includes/footer.php"); ?>


    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>

<script>

	$('#DeleteModal').on('show.bs.modal', function (event) 
	{
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var subject = button.data('subject') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var subjectid = button.data('subjectid')
	  var modal = $(this)
	  modal.find('.modal-object').text(subject)
	  modal.find('#itemid').val(subjectid)
	})

</script>