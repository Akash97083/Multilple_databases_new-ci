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

            <?php //print_r($CouponDetail); ?>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="frm_user" name="frm_user" method="post" action="<?php echo base_url('admin/coupon/coupon_data/'); ?>" enctype="multipart/form-data">
              <div class="box-body">
                
              
             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Coupon Code<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="coupon_code" name="coupon_code" placeholder="" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($CouponDetail['coupon_code']?$CouponDetail['coupon_code'] : '');?>" onblur="chk_coupon(this.value)" />
                    <span id="error" style="display:block; color: red"></span>
                  </div>
                </div>
                
                

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Coupon Type <span class="red">*</span></label>
                  <div class="col-sm-9">
                   <select name ="coupon_type" id="coupon_type" class="form-control" onchange="">
                   <option value="">Select Coupon Type</option>
                   <option value="flat" <?=$CouponDetail['coupon_type'] == 'flat' ? ' selected="selected"' : '';?>>Flat</option>
                  <option value="percentage" <?=$CouponDetail['coupon_type'] == 'percentage' ? ' selected="selected"' : '';?>>Percentage</option>
               
               </select>
                      </div>
                </div>


                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Coupon Value<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="coupon_value" name="coupon_value" placeholder="Coupon Value" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($CouponDetail['coupon_value']?number_format($CouponDetail['coupon_value']) : '');?>" />
                  </div>
                </div>


                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea name="description" placeholder="Description" class="col-xs-10 col-sm-5 form-control"/><?php echo htmlentities(($CouponDetail['decription']?$CouponDetail['decription'] : ''));?></textarea>
                     
                  </div>
                </div>

                


        <input type="hidden" name="coupon_id" value="<?php echo ($CouponDetail['id']?$CouponDetail['id'] : '');?>">
               
                
              </div>
              <!-- /.box-body -->
			  <?php $back_link = base_url('admin/coupon'); ?>
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
           coupon_code: {
                validators: {
                    notEmpty: {
                        message: 'Coupon Code is required and cannot be empty'
                    }
                }
            },
      
       coupon_type: {
                validators: {
                    notEmpty: {
                        message: 'Coupon Type is required and cannot be empty'
                    }
                }
            },
       coupon_value: {
                validators: {
                    /*between: {
                        min: 1,
                        max: 99,
                        message: 'The number of floors must be between 1 and 99'
                    },*/
                    integer: {
                        message: 'The value is not an integer'
                    },
                    notEmpty: {
                        message: 'Coupon Value is required and cannot be empty'
                    }
                }
            },

         }
    });
});

function chk_coupon(val){
 var coupon_id ='<?php echo ($CouponDetail['id']?$CouponDetail['id'] : '');?>';
 var v_error     = '1px solid #f32517';
 var v_ok        = '1px solid green';
 $.ajax({
    type:"POST",
    url:'<?php echo base_url('admin/coupon/coupon_check');?>',
    data:{'coupon_id':coupon_id,'coupon_name':val},
    success: function(data){
      if(data==1)
        { 
          //$("#name").val('');
           $("#name").css('border',v_error);
           $('#error').show();   
          $('#error').html("Coupon name already exists").slideDown(1000);
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