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
              <h3 class="box-title"></h3>
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
            
            <?php if($this->session->flashdata('errmsg')): ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                        <?php echo $this->session->flashdata('errmsg');?>
                    <br>
                </div>
           <?php endif; ?>
            </div>

            <?php //print_r($UserDetail); ?>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="frm_user" name="frm_user" method="post" action="<?php echo base_url('admin/User/user_data/'); ?>" enctype="multipart/form-data">
              <div class="box-body">
                
              
             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select location <span class="red">*</span></label>

                  <div class="col-sm-9">
                    <select class="control-label" name="branch_id">
                      <option value="">Select Branch</option>
                      <?php foreach($allbranch as $brn): 
                        if($brn['id'] == $UserDetail['branch_id']){
                          $selected = 'selected = selected';
                        }else{
                          $selected = '';
                        }?>
                        <option value="<?= $brn['id'];?>" <?php echo $selected;?>><?= $brn['branch_name'];?></option>
                      <?php endforeach;
                        ?>
                    </select>
                  </div>
                </div>

             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Name <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="" name="user_name" placeholder="User Name" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($UserDetail['full_name']?$UserDetail['full_name'] : '');?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Mobile Number <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="" name="mobile_number" placeholder="Mobile Number" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($UserDetail['contact_no']?$UserDetail['contact_no'] : '');?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Location</label>
                  <div class="col-sm-9">
                    <input type="text" id="" name="location" placeholder="User Location" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($UserDetail['location']?$UserDetail['location'] : '');?>">
                  </div>
                </div>

                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">User Email<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="email" id="email_id" name="email_id" placeholder="Email Id" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($UserDetail['email_id']?$UserDetail['email_id'] : '');?>" oninput="chk_email(this.value)"/> 
                    <span id="email_error" style="display:block; color: red"></span>
                  </div>

                </div>
                <?php if($UserDetail['id'] ==''){ ?>

                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">User Password<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" name="user_password" placeholder="User Password" class="col-xs-10 col-sm-5 form-control" value="" /> 
                   </div>

                </div>
              <?php }?>

                <input type="hidden" name="user_id" value="<?php echo ($UserDetail['id']?$UserDetail['id'] : '');?>">
               
                
              </div>
              <!-- /.box-body -->
			  <?php $back_link = base_url('admin/user'); ?>
              <div class="box-footer">
              	<div class="col-sm-8">
                  <a class="btn btn-default pull-right" href="<?php echo $back_link; ?>" style="margin-right:10px;">Cancel</a>
                  <button type="submit" class="btn btn-info pull-right" style="margin-right:10px;" id="sub">Submit</button>
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
<script>
  
   CKEDITOR.replace( '',{
    allowedContent: true,
  });
  </script>

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
           branch_id: {
                validators: {
                    notEmpty: {
                        message: 'Branch name is required and cannot be empty'
                    }
                }
            },

            user_name: {
                validators: {
                    notEmpty: {
                        message: 'User name is required and cannot be empty'
                    }
                }
            },
            mobile_number: {
                validators: {
                    notEmpty: {
                        message: 'Mobile is required and cannot be empty'
                    }
                }
            },
      email_id: {
                validators: {
                    notEmpty: {
                        message: 'Email Id is required and cannot be empty'
                    }
                }
            },
      <?php if($UserDetail['id'] ==''){ ?>
       user_password: {
                validators: {
                    notEmpty: {
                        message: 'User password is required and cannot be empty'
                    }
                }
            },
		      <?php }?>
         }
    });
});

function chk_email(val){
 var id ='<?php echo ($UserDetail['id']?$UserDetail['id'] : '');?>';
 var v_error     = '1px solid #f32517';
 var v_ok        = '1px solid green';
 $.ajax({
    type:"POST",
    url:'<?php echo base_url('admin/user/email_check');?>',
    data:{'id':id,'email_id':val},
    success: function(data){
      if(data==1)
        { 
          //$("#name").val('');
           $("#name").css('border',v_error);
           $('#email_error').show();   
          $('#email_error').html("User Email already exists").slideDown(1000);
          $('#sub').prop('disabled',true);
          return false; 
           }else{
          $("#email_id").css('border',v_ok);
          $('#email_error').slideUp(1000);
          $('#sub').prop('disabled',false);
        }
    }
 });
}

</script>

<?php $this->load->view('include/footer.php');?>