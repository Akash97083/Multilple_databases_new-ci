<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="treeview <?php if($this->uri->segment(2) == '' || $this->uri->segment(2) == 'dashboard'){ ?>active<?php } ?>">
          <a href="<?php echo base_url('admin/dashboard'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-red">3</small>
                <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <?php if($this->session->userdata('user_group') =='1'){
          if($this->session->userdata('admin_type') !='Super-admin'){?>
            <li class="treeview <?php if($this->uri->segment(2) == '' || $this->uri->segment(2) == 'company'){ ?>active<?php } ?>">
          <a href="<?php echo base_url('admin/company'); ?>">
            <i class="fa fa-shopping-cart"></i> <span>Manage Company</span>
          </a>
         </li>

        <li class="treeview <?php if($this->uri->segment(2) == '' || $this->uri->segment(2) == 'company'){ ?>active<?php } ?>">
        <a href="<?php echo base_url('admin/dashboard/profile'); ?>">
        <i class="fa fa-shopping-cart"></i> <span>User Profile</span>
        </a>
        </li>

       <?php } ?>

         <?php if($this->session->userdata('admin_type') =='Super-admin'){?>
          <li class="treeview <?php if($this->uri->segment(2) == '' || $this->uri->segment(2) == 'company'){ ?>active<?php } ?>">
          <a href="<?php echo base_url('admin/database'); ?>">
            <i class="fa fa-shopping-cart"></i> <span>Manage Database</span>
          </a>
         </li>
       <?php } ?>

        <?php
        
         }

        elseif($this->session->userdata('user_group') =='2'){ ?>

        <li class="treeview <?php if($this->uri->segment(2) == '' || $this->uri->segment(2) == 'branch'){ ?>active<?php } ?>">
                <a href="<?php echo base_url('admin/branch'); ?>">
                  <i class="fa fa-shopping-cart"></i> <span>Manage Branch </span>
                </a>
        </li>    


        <li class="treeview <?php if($this->uri->segment(2) == '' || $this->uri->segment(2) == 'user'){ ?>active<?php } ?>">
                <a href="<?php echo base_url('admin/user'); ?>">
                  <i class="fa fa-shopping-cart"></i> <span>Manage User </span>
                </a>
        </li>

        <li class="treeview <?php if($this->uri->segment(2) == '' || $this->uri->segment(2) == 'invoice'){ ?>active<?php } ?>">
                <a href="<?php echo base_url('admin/invoice'); ?>">
                  <i class="fa fa-shopping-cart"></i> <span>Manage Invoice </span>
                </a>

        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Masters</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview <?php if($this->uri->segment(2) == '' || $this->uri->segment(2) == 'item'){ ?>active<?php } ?>">
              <a href="<?php echo base_url('admin/item');?>"><i class="fa fa-circle-o"></i>Item Master</a>
            </li>
            <li><a href="<?php echo base_url('admin/costomer');?>"><i class="fa fa-circle-o"></i>Customer Master</a></li>
            <li>
              <a href="<?php echo base_url('admin/tat');?>">
                <i class="fa fa-circle-o"></i>TaT Master
              </a>
            </li>
            
          </ul>
        </li>
        

      <?php } ?>

    </ul>
    
    </section>
    <!-- /.sidebar -->
  </aside>