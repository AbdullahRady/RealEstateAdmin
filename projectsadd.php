<?php $page_title = "Projects"; ?>
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
            <li><a href="projects.php"><?= $page_title ?></a></li>
            <li class="active">Add Project</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
                <div class="box-header with-border">
                  <i class="fa fa-pencil"></i> <h3 class="box-title">Add Project</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                  
                   <div class="nav-tabs-custom">
                     <ul class="nav nav-tabs">
                       <li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
                       <li><a href="#tab_2" data-toggle="tab">Facilities</a></li>
                       <li><a href="#tab_3" data-toggle="tab">Types</a></li>
                     </ul>
                     <div class="tab-content">
                       <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                      <label for="projectname" class="col-sm-2 control-label">Project Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="projectname" placeholder="Project Name" required>
                      </div>
                    </div>                    
                    <div class="form-group">
                      <label for="projectdeveloper" class="col-sm-2 control-label">Developer</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="projectdeveloper" placeholder="Developer">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="projectdeliverydate" class="col-sm-2 control-label">Delivery Date</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" name="projectdeliverydate" placeholder="Delivery Date" minlength="4" maxlength="4" min="2000" max="2099">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="projectdescription" class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-10">
                        <textarea name="projectdescription" class="form-control" rows="3" placeholder="Description"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="projectpaymentterms" class="col-sm-2 control-label">Payment Terms</label>
                      <div class="col-sm-10">
                        <textarea name="projectdescription" class="form-control" rows="3" placeholder="Payment Terms"></textarea>
                      </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="projectimages" class="col-sm-2 control-label">Images</label>
                         <div class="col-sm-10">
                        <input type="file" name="projectimage1" id="projectimage1" class="form-control" />
                        <label class="col-sm-2 control-label"></label>
                        <input type="file" name="projectimage2" id="projectimage2" class="form-control" />
                        <label class="col-sm-2 control-label"></label>
                        <input type="file" name="projectimage3" id="projectimage3" class="form-control" />
                        <label class="col-sm-2 control-label"></label>
                        <input type="file" name="projectimage4" id="projectimage4" class="form-control" />
                        <label class="col-sm-2 control-label"></label>
                        <input type="file" name="projectimage5" id="projectimage5" class="form-control" />
                        <label class="col-sm-2 control-label"></label>
                        <input type="file" name="projectimage6" id="projectimage6" class="form-control" />
                        <label class="col-sm-2 control-label"></label>
                        <input type="file" name="projectimage7" id="projectimage7" class="form-control" />
                        <label class="col-sm-2 control-label"></label>
                        <input type="file" name="projectimage8" id="projectimage8" class="form-control" />
                        <label class="col-sm-2 control-label"></label>
                        <input type="file" name="projectimage9" id="projectimage9" class="form-control" />
                        <label class="col-sm-2 control-label"></label>
                        <input type="file" name="projectimage10" id="projectimage10" class="form-control" />
                        </div>
                    </div> 
                       </div><!-- /.tab-pane -->
                       <div class="tab-pane" id="tab_2">

                    	<div class="form-group">   
                          <div class="col-sm-10">                    
							<div class="checkbox">
                                 <label><input name="projectelevator" type="checkbox" value="1">Elevator</label>
                            </div> 
                            
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectsecurity" value="1">Security System</label>
                            </div>
                            
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectparking" value="1">Parking</label>
                            </div>
                            
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectsolar" value="1">Solar System</label>
                            </div> 
                            
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectlounge" value="1">Business Lounge</label>
                            </div>
                            
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectrestaurants" value="1">Restaurants</label>
                            </div>
                             
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectcafes" value="1">Cafes</label>
                            </div>
                            
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectclubs" value="1">Club Houses</label>
                            </div>
                             
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectgyms" value="1">Gym</label>
                            </div>
                            
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectspa" value="1">Spa</label>
                            </div>
                             
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectsauna" value="1">Sauna</label>
                            </div>
                            
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectpoolindoor" value="1">Pool Indoor</label>
                            </div> 
                             
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectpooloutdoor" value="1">Pool Outdoor</label>
                            </div>
                            
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectsupermarket" value="1">Supermarket</label>
                            </div>
                             
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectpharmacy" value="1">Pharmacy</label>
                            </div>
                            
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectplaygrounds" value="1">Playgrounds</label>
                            </div>
                            
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectwaterparks" value="1">Water Parks</label>
                            </div>
                            
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectmosque" value="1">Mosque</label>
                            </div>
                             
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectshoppingstores" value="1">Shopping Stores</label>
                            </div>
                            
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projectsmarthomes" value="1">Smarthomes</label>
                            </div>
                          </div>
                            
	                    </div>                            
                        
                       </div><!-- /.tab-pane -->
                       <div class="tab-pane" id="tab_3">
                    	<div class="form-group">   
                          <div class="col-sm-10">                    
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projecttype8" value="1">Apartment</label>
                            </div>
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projecttype7" value="1">Chalet</label>
                            </div>
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projecttype4" value="1">Duplex</label>
                            </div>
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projecttype6" value="1">Ground With Garden</label>
                            </div>
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projecttype5" value="1">Penthouse</label>
                            </div>
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projecttype1" value="1">Stand Alone Villa</label>
                            </div>
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projecttype2" value="1">Town House</label>
                            </div>
                            <div class="checkbox">
                                 <label><input type="checkbox" name="projecttype3" value="1">Twin House</label>
                            </div>
                          </div>
                        </div>  
                          
                       </div><!-- /.tab-pane -->
                     </div><!-- /.tab-content -->
                   </div>  
              
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="projects.php"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-info pull-right">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include ("includes/footer.php"); ?>
