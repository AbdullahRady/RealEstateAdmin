<?php $page_title = "Banner"; ?>
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
            <li class="active">Edit Banner</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
                <div class="box-header with-border">
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Edit Banner</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Link</th>
                        <th>Image</th>
                        <th>Sort Order</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		
		include("config.php");
		
		$banner_query = 
				"
					SELECT *
					FROM banner					
					ORDER BY bnr_sort_order 
				";
		
		$banner_sql = mysql_query($banner_query);
		
		$banner_count = mysql_num_rows($banner_sql);

		while($banner_row  = mysql_fetch_array($banner_sql))
		{
			$banner_id = $banner_row['bnr_id'];
			$banner_title = $banner_row['bnr_title'];
			$banner_link = $banner_row['bnr_link'];
			$banner_image = $banner_row['bnr_image'];
			$sort_order = $banner_row['bnr_sort_order'];
			
?>                     
                      <tr>
                        <td><input type="text" class="form-control" placeholder="Title" value="<?= $banner_title ?>" /></td>
                        <td><input type="text" class="form-control" placeholder="Link" value="<?= $banner_link ?>" /></td>
                        <td><label for="updatebannerimage<?= $banner_id ?>">
                                <img id="bannerimage<?= $banner_id ?>" name="bannerimage<?= $banner_id ?>" src="../img/slider/slides/<?= $banner_image ?>" width="187" height="70" alt="" style="cursor: pointer">
                                <input id="updatebannerimage<?= $banner_id ?>" name="updatebannerimage<?= $banner_id ?>" type="file" onchange="updateimage(this);" style="display: none" />
                            </label>
                        </td>
                        <td><input type="text" class="form-control" placeholder="Sort Order" value="<?= $sort_order ?>" /></td>
                        <td align="center"><button type="button" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                      </tr>
<?php

		}

?>                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Title</th>
                        <th>Link</th>
                        <th>Image</th>
                        <th>Sort Order</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="index.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>

<script src="dist/js/updateimage.js"></script>