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
			<?php if($succmsg!=''){?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
						<?php echo $succmsg; ?>
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
            </div>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="frm_user" name="frm_user" method="post" action="<?php echo base_url('admin/user/update_user/'); ?>" enctype="multipart/form-data">
              <div class="box-body">
                
              
             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Name <span class="red">*</span></label>
                  <div class="col-sm-5">
                    <input type="text" id="" name="user_name" placeholder="" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($users_detail['user_name']?$users_detail['user_name'] : '');?>" required="" />
                  </div>
                </div>
                
                
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-5">
                    <input type="email" id="" name="email" placeholder="" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($users_detail['email_id']?$users_detail['email_id'] : '');?>" />
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
                  <div class="col-sm-5">
                    <textarea name="address1" placeholder="Address1" class="col-xs-10 col-sm-5 form-control" style="resize:none;"><?php echo ($users_detail['address']?$users_detail['address'] : '');?></textarea> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Mobile Number <span class="red">*</span></label>
                  <div class="col-sm-5">
                    <input type="text" id="" name="mobile" placeholder="Mobile Number" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($users_detail['phoneno']?$users_detail['phoneno'] : '');?>" required="" />
                  </div>
                </div>
				
				
		


              
      	<input type="hidden" name="user_id" value="<?php echo ($users_detail['id']?$users_detail['id'] : '');?>">
               
                
              </div>
              <!-- /.box-body -->
			  <?php $back_link = base_url('admin/user'); ?>
              <div class="box-footer">
              	<div class="col-sm-8">


                    <a class="btn btn-default pull-right" href="<?php echo $back_link; ?>" style="margin-right:10px;">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right" style="margin-right:10px;">Submit</button>
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
  
<script type="application/javascript">
$(document).ready(function() {
    $('#frm_user').bootstrapValidator({
  		framework: 'bootstrap',
		excluded: [':disabled'],
        err: {
            container: function($field, validator) {
                return $field.parent().next('#messages');
            }
        },
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            user_name: {
                validators: {
                    notEmpty: {
                        message: 'Name is required and cannot be empty'
                    }
                }
            },
			
   	mobile: {
                validators: {
                    notEmpty: {
                        message: 'Mobile number is required and cannot be empty'
                    },
              stringLength: {
                        min: 10,
                        max: 10,
                        message: 'Mobile number must be 10 digit number'
                    },
				 integer: {
                        message: 'The value is not an integer'
                    },
				      },
            },
            
		
         }
    });
});

 function capacity(id){
 if(id=='2'){
  $("#no_of_capacity_meal").show();
   $("#delivery_capacity").val('');
  $("#delivery_capacity").hide();

  }
  if(id=='3'){
    $("#delivery_capacity").show();
    $("#no_of_capacity_meal").val('');
    $("#no_of_capacity_meal").hide();

  }
  if(id=='1'){
    $("#delivery_capacity").hide();
     $("#delivery_capacity").val('');
     $("#no_of_capacity_meal").hide();
     $("#no_of_capacity_meal").val('');

  }

 }
</script>

<?php $this->load->view('include/footer.php');?>