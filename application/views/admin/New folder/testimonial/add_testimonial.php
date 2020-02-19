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
            
          <?php if($this->session->flashdata('errormsg')): ?>
              <div class="alert alert-danger" role="alert">
              <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
              </button>
               <?php echo $this->session->flashdata('errormsg');?>
              <br>
              </div>
          <?php endif; ?>
            </div>

            <?php //print_r($cms_detail); ?>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="frm_user" name="frm_user" method="post" action="<?php echo base_url('admin/testimonials/add_testimonial_data/'); ?>" enctype="multipart/form-data">
              <div class="box-body">
                
              
             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Client Name In English <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="" name="client_name_en" placeholder="" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($testimonial_detail['name_english']?$testimonial_detail['name_english'] : '');?>" required=""/>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Client Name In Arabic <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="" name="client_name_ar" placeholder="" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($testimonial_detail['name_arabic']?$testimonial_detail['name_arabic'] : '');?>" required=""/>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description In English <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <textarea name="description" placeholder="Description" class="col-xs-10 col-sm-5 form-control" required="" id="english_editor"/><?php echo ($testimonial_detail['description']?$testimonial_detail['description'] : '');?></textarea>
                  </div>
                </div>


            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Arabic Description <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <textarea name="arabic_description" placeholder="Description" class="col-xs-10 col-sm-5 form-control" required="" id="arabic_editor" /><?php echo ($testimonial_detail['arabic_description']?$testimonial_detail['arabic_description'] : '');?></textarea>
                  </div>
            </div>

            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Update Image <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="file" id="" name="testimonialfile" placeholder="" class="col-xs-10 col-sm-5 form-control"/>
                  </div>
            </div>

            <?php if($testimonial_detail['id'] !=''){ ?>

            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Testimonial Image</label>
                  <div class="col-sm-9">
                    <img src="<?php echo base_url().'uploads/testimonials/'.$testimonial_detail['image']; ?>" height="100" width="150">
                  </div>
            </div>

          <?php } ?>



        <input type="hidden" name="testimonial_id" value="<?php echo ($testimonial_detail['id']?$testimonial_detail['id'] : '');?>">
               
                
              </div>
              <!-- /.box-body -->
			  <?php $back_link = base_url('admin/testimonials'); ?>
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

<script>
  
 CKEDITOR.replace( 'english_editor',{
  allowedContent: true,
  });   

  CKEDITOR.replace( 'arabic_editor',{
       language: 'ar',
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
            client_name_en: {
                validators: {
                    notEmpty: {
                        message: 'Client Name is required and cannot be empty'
                    }
                }
            },

           client_name_ar: {
                validators: {
                    notEmpty: {
                        message: 'Client Name Arabic is required and cannot be empty'
                    }
                }
            },
      
       description: {
                validators: {
                    notEmpty: {
                        message: 'English Description is required and cannot be empty'
                    }
                }
            },

      arabic_description: {
                validators: {
                    notEmpty: {
                        message: 'Arabic Description is required and cannot be empty'
                    }
                }
            },
    <?php if($testimonial_detail['id']==''){ ?>
    testimonialfile:{
        validators: {
                    notEmpty: {
                        message: 'Testimonial file is required and cannot be empty'
                    }
                }
      },

   <?php } ?>


			
   	// mobile: {
    //             validators: {
    //                 notEmpty: {
    //                     message: 'Mobile number is required and cannot be empty'
    //                 },
    //           stringLength: {
    //                     min: 10,
    //                     max: 10,
    //                     message: 'Mobile number must be 10 digit number'
    //                 },
				//  integer: {
    //                     message: 'The value is not an integer'
    //                 },
				//       },
    //         },
            
		
         }
    });
});
</script>

<?php $this->load->view('include/footer.php');?>