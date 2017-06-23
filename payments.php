<?php $page_title = "Payments"; ?>
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

        <!-- Main content -->
        <section class="content">
<?php

	if(isset($_GET['s']))
	{
		$s = $_GET['s'];
	}
	
	if(isset($s))
	{
		$notification_title = "Success";
		
		if($s == 1)
		{
			$notification_message = "Payment option added successfully";				
		}
		elseif($s == 2)
		{
			$notification_message = "Payment option updated successfully";				
		}
		elseif($s == 3)
		{
			$notification_message = "Payment option deleted successfully";				
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
                  <i class="fa fa-list"></i> <h3 class="box-title">Payment List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Payment Option</th>
                        <th>Sort Order</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		
		include("config.php");
		
		$payments_query = 
				"
					SELECT *
					FROM payment					
					ORDER BY pmt_id DESC
				";
		
		$payments_sql = mysql_query($payments_query);
		
		$payments_count = mysql_num_rows($payments_sql);

		while($payments_row  = mysql_fetch_array($payments_sql))
		{
			$payment_option_id = $payments_row['pmt_id'];
			$payment_option = $payments_row['pmt_option'];
			$sort_order = $payments_row['pmt_sort_order'];
			
?>                     
                      <tr>
                        <td><?= $payment_option ?></td>
                        <td><?= $sort_order ?></td>
                        <td align="center"> <a href="paymentsedit.php?p=<?= $payment_option_id ?>"><button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i></button></a> </td>
                      </tr>
<?php

		}

?>                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Payment Option</th>
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
