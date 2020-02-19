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
            <form class="form-horizontal" id="frm_user" name="frm_user" method="post" action="<?php echo base_url('admin/gallery/add_gallery_data/'); ?>" enctype="multipart/form-data">
              <div class="box-body">
                
              
             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Image Name <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="" name="image_name_en" placeholder="" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($gallery_detail['name_english']?$gallery_detail['name_english'] : '');?>" required=""/>
                  </div>
              </div>

         <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"><?php echo($gallery_detail==''?'Add':'Update');?> Slider <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="file" id="" name="galleryfile" placeholder="" class="col-xs-10 col-sm-5 form-control"/>
                  </div>
            </div>

            <?php if($gallery_detail['id'] !=''){ ?>

            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Slider Image</label>
                  <div class="col-sm-9">
                    <img src="<?php echo base_url().'uploads/gallery/'.$gallery_detail['image']; ?>" height="100" width="150">
                  </div>
            </div>

          <?php } ?>



        <input type="hidden" name="gallery_id" value="<?php echo ($gallery_detail['id']?$gallery_detail['id'] : '');?>">
               
                
              </div>
              <!-- /.box-body -->
			  <?php $back_link = base_url('admin/gallery'); ?>
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
            image_name_en: {
                validators: {
                    notEmpty: {
                        message: 'Image Name is required and cannot be empty'
                    }
                }
            },

    <?php if($gallery_detail['id']==''){ ?>
    galleryfile:{
        validators: {
                    notEmpty: {
                        message: 'Slider image is required and cannot be empty'
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

$(function(){
      $('#english_editor').froalaEditor({
        //toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|','color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat','paragraphFormat','align', 'formatOL', 'formatUL', 'outdent', 'indent','-', 'insertLink', 'insertImage', 'insertVideo','insertTable', '|','specialCharacters', 'insertHR', 'selectAll', 'clearFormatting', '|','html', '|', 'undo', 'redo'],
        toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline','color', 'inlineStyle','paragraphFormat','align', 'formatOL', 'formatUL','|','insertLink','insertImage', 'insertVideo','insertTable','specialCharacters','clearFormatting','html'],
        height:300,
        //charCounterMax: 160,
        //pastePlain: true,

      });

    });

$(function(){
      $('#arabic_editor').froalaEditor({
        //toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|','color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat','paragraphFormat','align', 'formatOL', 'formatUL', 'outdent', 'indent','-', 'insertLink', 'insertImage', 'insertVideo','insertTable', '|','specialCharacters', 'insertHR', 'selectAll', 'clearFormatting', '|','html', '|', 'undo', 'redo'],
        toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline','color', 'inlineStyle','paragraphFormat','align', 'formatOL', 'formatUL','|','insertLink','insertImage', 'insertVideo','insertTable','specialCharacters','clearFormatting','html'],
        direction: 'rtl',
        height:300,
        //charCounterMax: 160,
        //pastePlain: true,

      });

    });

</script>

<?php $this->load->view('include/footer.php');?>