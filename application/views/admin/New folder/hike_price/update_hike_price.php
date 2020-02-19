<?php $this->load->view('include/meta.php');?>
<?php $this->load->view('include/header.php');?>
<!--sidebar-->
<?php $this->load->view('include/sidebar.php');?>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

            <?php //print_r($hikeDetail); ?>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="frm_user" name="frm_user" method="post" action="<?php echo base_url('admin/hike_price/hike_price_data/'); ?>" enctype="multipart/form-data">
              <div class="box-body">
              
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Title<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" name="title" placeholder="Title" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($hikeDetail['title']?$hikeDetail['title'] : '');?>">
                  </div>

                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Start Date<span class="red">*</span>
                  </label>
                  <div class="col-sm-9">
                    <input type="text" name="start" placeholder="Start Date" class="col-xs-10 col-sm-5 form-control datepicker" value="<?php echo ($hikeDetail['start_date']?$hikeDetail['start_date'] : '');?>">
                  </div>

                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">High Percentage<span class="red">*</span>
                  </label>
                  <div class="col-sm-9">
                    <input type="text" name="value" placeholder="High Percentage" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($hikeDetail['hike_value']?$hikeDetail['hike_value'] : '');?>">
                  </div>

                </div>

                


        <input type="hidden" name="hike_price_id" value="<?php echo ($hikeDetail['id']?$hikeDetail['id'] : '');?>">
               
                
              </div>
              <!-- /.box-body -->
			  <?php $back_link = base_url('admin/category'); ?>
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
           title: {
                validators: {
                    notEmpty: {
                        message: 'Title is required and cannot be empty'
                    }
                }
            },
      
       start: {
                validators: {
                    notEmpty: {
                        message: 'Start date is required and cannot be empty'
                    }
                }
            },



      value: {
                validators: {
                    between: {
                        min: 1,
                        max: 99,
                        message: 'The number of floors must be between 1 and 99'
                    },
                    integer: {
                        message: 'The value is not an integer'
                    },
                    notEmpty: {
                        message: 'Parentage is required and cannot be empty'
                    }
                }
            },

		
         }
    });

    $('.datepicker').datepicker({
      changeMonth:true,
      changeYear:true,
      dateFormat:'yy-mm-dd',
      //minDate: new Date('<?php //echo $financial_year_srart;?>'),
      //maxDate: new Date('<?php //echo $financial_year_end;?>'),
      //minDate: -70,
      //maxDate:0,
      //maxDate: "+1M +1D"
      //minDate:'0d'
      })
});

function chk_categoery(val){
 var cat_id ='<?php echo ($hikeDetail['id']?$hikeDetail['id'] : '');?>';
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