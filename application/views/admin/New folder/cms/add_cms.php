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

            <?php //print_r($cms_detail); ?>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="frm_user" name="frm_user" method="post" action="<?php echo base_url('admin/cms/update_cms/'); ?>" enctype="multipart/form-data">
              <div class="box-body">
                
              
             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Alias <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="" name="alias" placeholder="" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($cms_detail['alias']?$cms_detail['alias'] : '');?>" required="" readonly/>
                  </div>
                </div>
                
                

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Heading</label>
                  <div class="col-sm-9">
                    <textarea name="heading" placeholder="Heading" class="col-xs-10 col-sm-5 form-control" style="resize:none;"><?php echo ($cms_detail['heading']?$cms_detail['heading'] : '');?></textarea> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <textarea name="description" placeholder="Description" class="col-xs-10 col-sm-5 form-control" required="" id="english_editor"/><?php echo htmlentities(($cms_detail['description']?$cms_detail['description'] : ''));?></textarea>
                  </div>
                </div>


            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Arabic Description <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <textarea name="arabic_description" placeholder="Description" class="col-xs-10 col-sm-5 form-control" required="" id="arabic_editor" /><?php echo ($cms_detail['arabic_description']?$cms_detail['arabic_description'] : '');?></textarea>
                  </div>
            </div>


        <input type="hidden" name="cms_id" value="<?php echo ($cms_detail['id']?$cms_detail['id'] : '');?>">
               
                
              </div>
              <!-- /.box-body -->
			  <?php $back_link = base_url('admin/cms'); ?>
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
            alias: {
                validators: {
                    notEmpty: {
                        message: 'Alias is required and cannot be empty'
                    }
                }
            },

           heading: {
                validators: {
                    notEmpty: {
                        message: 'Heading is required and cannot be empty'
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
            
		
         }
    });
});

</script>

<?php $this->load->view('include/footer.php');?>