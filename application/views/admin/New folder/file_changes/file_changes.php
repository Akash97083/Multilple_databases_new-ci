<?php $this->load->view('include/meta.php');?>
<?php $this->load->view('include/header.php');?>
<!--sidebar-->
<?php $this->load->view('include/sidebar.php');?>
<!--end Sidebar-->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $page_title; ?>
      </h1>
      <ol class="breadcrumb">
        <?php echo $breadcrumb; ?>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php //echo $page_title; ?></h3>
            </div>
            
            
            <div class="col-xs-12">
			<?php
      $succmsg = $this->input->get('sucess', TRUE);
       if($succmsg!=''){?>
                <div class="alert alert-success" id="sucess">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
						Message has been sent successfully.
                    <br>
                </div>
            <?php } ?>
            
            <?php if($errmsg!=''){?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                        <?php echo $errmsg; ?>
                    <br>
                </div>
           <?php } ?>

           <div class="alert alert-danger alert-dismissable fade in" style="display: none;" id="error_msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                    <span id="error"></span>
                </div>

            </div>
           <div class="alert alert-success" id="response" style="display: none;"></div>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="frm_user" name="frm_user" method="post" action="<?php echo base_url('admin/cms/do_fileChange/'); ?>" enctype="multipart/form-data">
              <div class="box-body">
                
              
             

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Css</label>
                  <div class="col-sm-5">
                    <textarea name="css" id="edit" placeholder="Css" class="col-xs-10 col-sm-5 form-control" style="resize:none;" onmouseout="chk_flieContant(this.value)"><?php foreach($css as $newline){
                      echo $newline;

                        }?></textarea> 
                  </div>
                </div>
        <input type="hidden" name="user_id" value="<?php echo ($users_detail['id']?$users_detail['id'] : '');?>">
               
                
              </div>
              <!-- /.box-body -->
			  <?php $back_link = base_url('user'); ?>
              <div class="box-footer">
              	<div class="col-sm-8">
                 <a class="btn btn-default pull-right" href="#" style="margin-right:10px;">Cancel</a>
                    <input type="Submit" class="btn btn-info pull-right" style="margin-right:10px;" value="Submit" />
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <script type="text/javascript">
    function chk_flieContant(val){
      alert(val);

    }
  </script>

<?php $this->load->view('include/footer.php');?>