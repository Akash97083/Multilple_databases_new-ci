<?php $this->load->view('front/include/meta.php');?>
<?php $this->load->view('front/include/header.php');?>
<!--sidebar-->
<?php $this->load->view('front/include/sidebar.php');?>
<!--end Sidebar-->

  <div class="content-wrapper">
    
    <section class="content-header">
      <h1>
        <?php echo $page_title;?>
      </h1>
      <?php //print_r($this->session->userdata);?>
    </section>
    
  </div>

<?php $this->load->view('front/include/footer.php');?>
