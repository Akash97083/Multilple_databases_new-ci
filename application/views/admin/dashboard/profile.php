<?php $this->load->view('include/meta.php');?>
<?php $this->load->view('include/header.php');?>
<!--sidebar-->
<?php $this->load->view('include/sidebar.php');?>


<!--end Sidebar-->

  <div class="content-wrapper">
    
    <section class="content-header">
      <h1>
        <?php echo $page_title;?>
      <?php
         //echo $this->db->database;
       //print_r($this->session->userdata);
      //echo $this->session->userdata('user_group');
      
      ?>
    </section>
    
    <section class="content">
      <div class="col-md-6" id="user_contect">
      <div class="input-group input-group-sm">
      <input type="text" class="form-control" id="customer_phone" placeholder="Enter User Contect number">
      <span class="input-group-btn">
      <button type="button" class="btn btn-info btn-flat" onclick="user_profile()">Go!</button>
      </span>
      </div>
      </div>

      <div class="row" id="profile_div" style="display: none;">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo $this->config->item('css_images_js_base_url');?>/img/user3-128x128.jpg" alt="User profile picture">

              <h3 class="profile-username text-center">Nina Mcintire</h3>

              <p class="text-muted text-center">Software Engineer</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i>Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#favorite" data-toggle="tab">favorite Item &nbsp;<small class="label pull-right bg-green">5</small>
              
              </a>
              </li>
              <li><a href="#timeline" data-toggle="tab">Cart-item &nbsp;<small class="label pull-right bg-green">4</small>
              </a>
              </li>
              <li><a href="#order" data-toggle="tab">Last Order &nbsp;<small class="label pull-right bg-green">5</small>
              </a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="favorite">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="<?php echo $this->config->item('css_images_js_base_url');?>/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#" title="Item-detail">Mr.Jonathan Burke Jr.</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Shared publicly - 7:30 PM today</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>
                  

                  

                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="<?php echo $this->config->item('css_images_js_base_url');?>/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#" title="Item-detail">Miss.Sarah Ross</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>

                  
                </div>
                <!-- /.post -->

                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="<?php echo $this->config->item('css_images_js_base_url');?>/img/user3-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#" title="Item-detail">Mrs.Priyanka Mukhargee</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>

                  
                </div>
                <!-- /.post -->

                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="<?php echo $this->config->item('css_images_js_base_url');?>/img/user8-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#" title="Item-detail">Mr.Arka Mukhargee</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>

                  
                </div>
                <!-- /.post -->

                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="<?php echo $this->config->item('css_images_js_base_url');?>/img/user2-160x160.jpg" alt="User Image">
                        <span class="username">
                          <a href="#" title="Item-detail">Mr.Vishal Gupta</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>

                  <a class="btn btn-app">
                  <span class="badge bg-green">26</span>
                  <i class="fa fa-barcode"></i> Items
                  </a>

                  
                </div>
                <!-- /.post -->

                
              </div>

              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header"><a href="#">Nina Mcintire</a> Cart Items</h3>

                      <div class="timeline-body">
                        <img src="<?php echo $this->config->item('css_images_js_base_url');?>/img/user1-128x128.jpg" alt="..." class="margin">
                        <img src="<?php echo $this->config->item('css_images_js_base_url');?>/img/user3-128x128.jpg" alt="..." class="margin">
                        <img src="<?php echo $this->config->item('css_images_js_base_url');?>/img/user5-128x128.jpg" alt="..." class="margin">
                        <img src="<?php echo $this->config->item('css_images_js_base_url');?>/img/user7-128x128.jpg" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <div class="tab-pane" id="order">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL #</th>
                  <th>Invoice No</th>
                  <th>Booking Date</th>
                  <th>Total Amount</th>
                  
                  
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><a href="#" title="Invoice-detail" data-toggle="modal" data-target="#myModal" onclick="open_model('INV-001')">INV-001<small class="label pull-right bg-yellow">2</small></a></td>
                    <td>1-03-2020</td>
                    <td>1,200</td>
                  </tr>

                  <tr>
                    <td>2</td>
                    <td><a href="#" title="Invoice-detail" data-toggle="modal" data-target="#myModal" onclick="open_model('INV-002')">INV-002<small class="label pull-right bg-yellow">2</small></a></td>
                    <td>28-02-2020</td>
                    <td>1,200</td>
                  </tr>

                  <tr>
                    <td>3</td>
                    <td><a href="#" title="Invoice-detail" data-toggle="modal" data-target="#myModal" onclick="open_model('INV-003')">INV-003<small class="label pull-right bg-yellow">2</small></a></td>
                    <td>25-02-2020</td>
                    <td>1,800</td>
                  </tr>

                  <tr>
                    <td>4</td>
                    <td><a href="#" title="Invoice-detail" data-toggle="modal" data-target="#myModal" onclick="open_model('INV-004')">INV-004<small class="label pull-right bg-yellow">2</small></a></td>
                    <td>15-02-2020</td>
                    <td>1,900</td>
                  </tr>

                  <tr>
                    <td>5</td>
                    <td><a href="#" title="Invoice-detail" data-toggle="modal" data-target="#myModal" onclick="open_model('INV-006')">INV-006<span class="badge bg-yellow">2</span></a></td>
                    <td>05-02-2020</td>
                    <td>1,200</td>
                  </tr>

                 
                </tbody>
              </table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    
  </div>
  <!--Model-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Invoice detail - INV001</h4>
        </div>
        <div class="modal-body">

          <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL #</th>
                  <th>Image</th>
                  <th>CategoeryName</th>
                  <th>ItemName</th>
                  <th>ItemPrice</th>
                  
                  
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><img class="profile-user-img img-responsive img-circle" src="http://localhost/Multilple_databases_new/webadmin/public//img/user4-128x128.jpg" alt="User profile picture"></td>
                    <td>Test</td>
                    <td>Test1</td>
                    <td>600</td>
                  </tr>

                  <tr>
                    <td>2</td>
                    <td><img class="profile-user-img img-responsive img-circle" src="http://localhost/Multilple_databases_new/webadmin/public//img/user1-128x128.jpg"></td>
                    <td>Test</td>
                    <td>Test2</td>
                    <td>600</td>
                  </tr>

                 
                </tbody>
              </table>


          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--End Model-->

  <script type="text/javascript">
    function open_model(elm){
        

    }

   function user_profile(){
    var customer_phone = $('#customer_phone').val();
    $('#user_contect').hide();
    $('#profile_div').show();

   }
    
  </script>

<?php $this->load->view('include/footer.php');?>
