<?php $page_title = "Dashboard"; ?>
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
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->

<?php
		
		include("config.php");
		
		$properties_query = 
				"
					SELECT *
					FROM property
				";
		
		$properties_sql = mysql_query($properties_query);
		
		$properties_count = mysql_num_rows($properties_sql);

?>              
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?= $properties_count ?></h3>
                  <p>Properties</p>
                </div>
                <div class="icon">
                  <i class="fa fa-building-o"></i>
                </div>
                <a href="properties.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->

<?php
		
		$projects_query = 
				"
					SELECT *
					FROM project
				";
		
		$projects_sql = mysql_query($projects_query);
		
		$projects_count = mysql_num_rows($projects_sql);

?>              
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?= $projects_count ?></h3>
                  <p>Projects</p>
                </div>
                <div class="icon">
                  <i class="fa fa-folder-o"></i>
                </div>
                <a href="projects.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
<?php
		
		include("config.php");
		
		$pending_properties_query = 
				"
					SELECT *
					FROM property
					WHERE prp_status = 0
				";
		
		$pending_properties_sql = mysql_query($pending_properties_query);
		
		$pending_properties_count = mysql_num_rows($pending_properties_sql);

?>               
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?= $pending_properties_count ?></h3>
                  <p>Pending Approvals</p>
                </div>
                <div class="icon">
                  <i class="fa fa-check-circle"></i>
                </div>
                <a href="pendingproperties.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->

<?php
		
		$clients_query = 
				"
					SELECT *
					FROM user
					WHERE usr_type = 2
					OR usr_type = 4
				";
		
		$clients_query_sql = mysql_query($clients_query);
		
		$clients_query_count = mysql_num_rows($clients_query_sql);

?>               
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?= $clients_query_count ?></h3>
                  <p>Client Registrations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="clients.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          
          <div class="box box-info">
                <div class="box-header with-border">
                  <i class="fa fa-building-o"></i> <h3 class="box-title">Latest Properties</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Property Title</th>
                          <th>Date Added</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
<?php

		$properties_query .= 
				"					
					ORDER BY prp_id DESC
					LIMIT 5
				";
		
		$properties_sql = mysql_query($properties_query);
		
		while($properties_row  = mysql_fetch_array($properties_sql))
		{
			$property_id = $properties_row['prp_id'];
			$property_title = $properties_row['prp_title'];
			$property_listing_date = $properties_row['prp_listing_date'];
			$property_status = $properties_row['prp_status'];
			
			$property_listing_date = date_create($property_listing_date);
			$property_listing_date = date_format($property_listing_date,"d/m/Y");
			
			date_default_timezone_set("Africa/Cairo");
			
			if($property_status == 1)
			{
				$status_label = "Approved";
				$status_class = "label-success";
			}
			elseif($property_status == 0)
			{
				$status_label = "Pending";
				$status_class = "label-warning";
			}

?>
                        <tr>
                          <td><a href="#"><?= $property_id ?></a></td>
                          <td><?= $property_title ?></td>
                          <td><?= $property_listing_date ?></td>
                          <td><span class="label <?= $status_class ?>"><?= $status_label ?></span></td>
                          <td><a href="propertiesview.php?p=<?= $property_id ?>"><button type="button" class="btn btn-info"><i class="fa fa-eye"></i></button></a></td>
                        </tr>
<?php
			
		}

?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="properties.php" class="btn btn-sm btn-default btn-flat pull-right">View All Properties</a>
                </div><!-- /.box-footer -->
              </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
