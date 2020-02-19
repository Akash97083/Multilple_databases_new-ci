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

            <?php //print_r($BranchDetail); ?>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="frm_user" name="frm_user" method="post" action="<?php echo base_url('admin/branch/branch_data/'); ?>" enctype="multipart/form-data">
              <div class="box-body">
                
              
             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select Company<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <select name="company_id">
                      <option value="">Select Company</option>
                      <?php foreach($all_company as $company):
                        if($company['id'] == $BranchDetail['company_id']){
                          $selected = 'selected=selected';
                        }else{
                          $selected = '';
                        }?>
                        <option value="<?php echo $company['id'];?>" <?php echo $selected;?>><?php echo $company['company_name'];?></option>
                      <?php endforeach;?>
                      
                    </select>
                  </div>
                </div>

             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Branch Name<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="" name="branch_name" placeholder="Branch Name" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($BranchDetail['branch_name']?$BranchDetail['branch_name'] : '');?>">
                  </div>
                </div>
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Branch Code<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="" name="branch_code" placeholder="Branch Code" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($BranchDetail['branch_code']?$BranchDetail['branch_code'] : '');?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Branch Description</label>
                  <div class="col-sm-9">
                    <textarea name="branch_description" placeholder="Branch Description" class="col-xs-10 col-sm-5 form-control"/><?php echo htmlentities(($BranchDetail['branch_description']?$BranchDetail['branch_description'] : ''));?></textarea>
                     
                  </div>
                </div>
          <input type="hidden" name="branch_id" value="<?php echo ($BranchDetail['id']?$BranchDetail['id'] : '');?>">
               
                
              </div>
              <!-- /.box-body -->
			  <?php $back_link = base_url('admin/branch'); ?>
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
          company_id:{
            validators: {
                    notEmpty: {
                        message: 'Company name is required and cannot be empty'
                    }
                }

          },
           branch_name: {
                validators: {
                    notEmpty: {
                        message: 'Branch name is required and cannot be empty'
                    }
                }
            },
      
       branch_code: {
                validators: {
                    notEmpty: {
                        message: 'Branch code is required and cannot be empty'
                    }
                }
            },

		
         }
    });
});

function chk_categoery(val){
 var cat_id ='<?php echo ($BranchDetail['id']?$BranchDetail['id'] : '');?>';
 var v_error     = '1px solid #f32517';
 var v_ok        = '1px solid green';
 $.ajax({
    type:"POST",
    url:'<?php echo base_url('admin/category/category_check');?>',
    data:{'cat_id':cat_id,'category_name':val},
    success: function(data){
      if(data==1)
        { 
          //$("#name").val('');
           $("#name").css('border',v_error);
           $('#error').show();   
          $('#error').html("Category name already exists").slideDown(1000);
          $('#sub').prop('disabled',true);
          return false; 
           
           //$('.alert_mssg').html("Duplicate location").fadeIn(1000).fadeOut(3000);
          //$('#update_location_'+btn_val).val('');
        }else{
          $("#name").css('border',v_ok);
          $('#error').slideUp(1000);
          $('#sub').prop('disabled',false);
        }
    }
 });
}

</script>

<?php $this->load->view('include/footer.php');?>