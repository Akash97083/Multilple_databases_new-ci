<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="treeview <?php if($this->uri->segment(2) == '' || $this->uri->segment(2) == 'dashboard'){ ?>active<?php } ?>">
          <a href="<?php echo base_url('user/dashboard'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview <?php if($this->uri->segment(2) == '' || $this->uri->segment(2) == 'user_invoice'){ ?>active<?php } ?>">
          <a href="<?php echo base_url('user_invoice'); ?>">
            <i class="fa fa-dashboard"></i> <span>Invoice</span>
          </a>
        </li>

    </ul>
    </section>
    <!-- /.sidebar -->
  </aside>