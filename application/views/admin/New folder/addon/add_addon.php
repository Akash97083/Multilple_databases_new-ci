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
            <form class="form-horizontal" id="frm_user" name="frm_user" method="post" action="<?php echo base_url('admin/addon/add_addon_data/'); ?>" enctype="multipart/form-data">
              <div class="box-body">
                
              
             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Addon Name<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="addon_name" name="addon_name" placeholder="Addon Name" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($addon_detail['addon_name']?$addon_detail['addon_name'] : '');?>" required=""/>
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Price<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="price" name="price" placeholder="Price" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($addon_detail['addon_price']?$addon_detail['addon_price'] : '');?>" required=""/>
                  </div>
              </div>

         <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"><?php echo($addon_detail==''?'Add':'Update');?> Image <span class="red">*</span></label>
                  <div class="col-sm-9">
                    <input type="file" id="" name="addonfile" placeholder="" class="col-xs-10 col-sm-5 form-control"/>
                  </div>
            </div>

            <?php if($addon_detail['id'] !=''){ ?>

            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Addon Image</label>
                  <div class="col-sm-9">
                    <img src="<?php echo base_url().'uploads/addon/'.$addon_detail['image']; ?>" height="100" width="150">
                  </div>
            </div>

          <?php } ?>



        <input type="hidden" name="addon_id" value="<?php echo ($addon_detail['id']?$addon_detail['id'] : '');?>">
               
                
              </div>
              <!-- /.box-body -->
			  <?php $back_link = base_url('admin/addon'); ?>
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
            addon_name: {
                validators: {
                    notEmpty: {
                        message: 'Addon Name is required and cannot be empty'
                    }
                }
            },

            price: {
                validators: {
                    notEmpty: {
                        message: 'Priceis required and cannot be empty'
                    }
                }
            },


    <?php if($addon_detail['id']==''){ ?>
    addonfile:{
        validators: {
                    notEmpty: {
                        message: 'Addon image is required and cannot be empty'
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