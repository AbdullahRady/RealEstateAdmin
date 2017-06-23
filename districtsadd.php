<?php $page_title = "Districts"; ?>
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
            <li><a href="districts.php"><?= $page_title ?></a></li>
            <li class="active">Add District</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
                <div class="box-header with-border">
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Add District</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="districtname" class="col-sm-2 control-label">District Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="districtname" placeholder="District Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="sortorder" class="col-sm-2 control-label">Sort Order</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="sortorder" placeholder="Sort Order">
                      </div>
                    </div>
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="districts.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
