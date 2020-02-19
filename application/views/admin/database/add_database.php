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

            <?php //print_r($DbDetail); ?>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="frm_user" name="frm_user" method="post" action="<?php echo base_url('admin/database/database_data/'); ?>" enctype="multipart/form-data">
              <div class="box-body">

              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Admin type</label>
                  <div class="col-sm-9">
                    
                    <select name ="admin_type" id="admin_type" class="form-control">
                          <option value="">Select Admin Type </option>
                          <option value="Admin" <?php echo ($DbDetail['admin_type']=='Admin'?'selected=""':'');?>>Admin</option>
                          <option value="Super-admin" <?php echo ($DbDetail['admin_type']=='Super-admin'?'selected=""':'');?>>Super-admin</option>
                          </select>
                   
                  </div>
                </div>


              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">PIN<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="email_id" name="pin" placeholder="PIN" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($DbDetail['pin']?$DbDetail['pin'] : '');?>" oninput="chk_pin(this.value)"/> 
                    <span id="email_error" style="display:block; color: red"></span>
                  </div>

                </div>
                
              
             

             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Project Name <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="" name="project_name" placeholder="Project Name" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($DbDetail['project_name']?$DbDetail['project_name'] : '');?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Host Name <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="" name="host_name" placeholder="Host Name" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($DbDetail['hostname']?$DbDetail['hostname'] : '');?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">User Name<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="" name="username" placeholder="User Name" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($DbDetail['username']?$DbDetail['username'] : '');?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Database Name<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="" name="db_name" placeholder="Database Name" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($DbDetail['db_name']?$DbDetail['db_name'] : '');?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Databases Password<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" name="db_password" placeholder="Databases Password" class="col-xs-10 col-sm-5 form-control" value="" /> 
                   </div>

                </div>
              

                <input type="hidden" name="database_id" value="<?php echo ($DbDetail['id']?$DbDetail['id'] : '');?>">
               
                
              </div>
              <!-- /.box-body -->
			  <?php $back_link = base_url('admin/database'); ?>
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
          
          admin_type: {
                validators: {
                    notEmpty: {
                        message: 'Admin is required and cannot be empty'
                    }
                }
            },
           pin: {
                validators: {
                    notEmpty: {
                        message: 'pin is required and cannot be empty'
                    }
                }
            },

            project_name: {
                validators: {
                    notEmpty: {
                        message: 'User name is required and cannot be empty'
                    }
                }
            },
            host_name: {
                validators: {
                    notEmpty: {
                        message: 'Host Name is required and cannot be empty'
                    }
                }
            },
      username: {
                validators: {
                    notEmpty: {
                        message: 'User Name is required and cannot be empty'
                    }
                }
            },
      db_name: {
                validators: {
                    notEmpty: {
                        message: 'Database Name is required and cannot be empty'
                    }
                }
            },
		      
         }
    });
});

function chk_pin(val){
 var id ='<?php echo ($DbDetail['id']?$DbDetail['id'] : '');?>';
 var v_error     = '1px solid #f32517';
 var v_ok        = '1px solid green';
 $.ajax({
    type:"POST",
    url:'<?php echo base_url('admin/database/pin_check');?>',
    data:{'id':id,'pin':val},
    success: function(data){
      if(data==1)
        { 
          //$("#name").val('');
           $("#name").css('border',v_error);
           $('#email_error').show();   
          $('#email_error').html("PIN already exists").slideDown(1000);
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