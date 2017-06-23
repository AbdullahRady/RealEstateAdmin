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
            <li><a href="payments.php"><?= $page_title ?></a></li>
            <li class="active">Edit Payment</li>
          </ol>
        </section>

<?php

	if(!isset($_GET['p']))
		header("Location: payments.php");
	else
	{
		$payment_id = $_GET['p'];
		
		include("config.php");
		
		if(isset($_POST['updatepayment']))
		{
			
			$payment_option = $_POST['paymentoption']; 
			$sort_order = $_POST['sortorder'];
					
			$payment_query = 
			"
				UPDATE payment 
				SET pmt_option ='$payment_option', pmt_sort_order = '$sort_order'
				WHERE pmt_id = '$payment_id'
			";
			$payment_sql = mysql_query($payment_query);
			
			if($payment_sql)
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
			$payment_query = 
					"
						SELECT *
						FROM payment
						WHERE pmt_id = '$payment_id'
						LIMIT 1
					";
			
			$payment_sql = mysql_query($payment_query);
			
			$payment_count = mysql_num_rows($payment_sql);	
			
			if($payment_count == 0)
				header("Location: payments.php");
			
			while($payment_row  = mysql_fetch_array($payment_sql))
			{
				$payment_id = $payment_row['pmt_id'];
				$payment_option = $payment_row['pmt_option'];
				$sort_order = $payment_row['pmt_sort_order'];
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
				$notification_message = "There was an error updating payment option";
		}
		else
		{
			header("location: payments.php?s=2");
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
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Edit Payment</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="paymentform" action="<?= $_SERVER['PHP_SELF'];?>?p=<?= $payment_id ?>" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="paymentoption" class="col-sm-2 control-label">Payment Option</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="paymentoption" placeholder="Payment Option" value="<?= $payment_option ?>">
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
                    <a href="payments.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right" name="updatepayment">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
