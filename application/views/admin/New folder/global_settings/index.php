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

			<?php if($this->session->flashdata('succmsg')){?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
					<?php echo $this->session->flashdata('succmsg'); ?>
                    <br>
                </div>
            <?php } ?>
            
            </div>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="frm_global_settings" name="frm_global_settings" method="post" action="<?php echo base_url('admin/global_settings/do_global_setting/'); ?>" enctype="multipart/form-data">
              <div class="box-body">
              
              <h4><i class="fa fa-info blue"></i> Site Information</h4>
              
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $global['global_site_name_en']['field_name'];?><span class="red">*</span></label>
                  <div class="col-sm-5">
                    <input type="text" id="<?php echo $global['global_site_name_en']['field_key'];?>" name="<?php echo $global['global_site_name_en']['field_key'];?>" placeholder="<?php echo $global['global_site_name_en']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" value="<?php echo $global['global_site_name_en']['field_value'];?>" />
                  </div>
                </div>
                
                
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $global['global_meta_title_en']['field_name'];?><span class="red">*</span></label>
                  <div class="col-sm-5">
                    <input type="text" id="<?php echo $global['global_meta_title_en']['field_key'];?>" name="<?php echo $global['global_meta_title_en']['field_key'];?>" placeholder="<?php echo $global['global_meta_title_en']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" value="<?php echo $global['global_meta_title_en']['field_value'];?>" />
                  </div>
                </div>
                
                
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $global['global_meta_keywords_en']['field_name'];?><span class="red">*</span></label>
                  <div class="col-sm-5">
                    <input type="text" id="<?php echo $global['global_meta_keywords_en']['field_key'];?>" name="<?php echo $global['global_meta_keywords_en']['field_key'];?>" placeholder="<?php echo $global['global_meta_keywords_en']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" value="<?php echo $global['global_meta_keywords_en']['field_value'];?>" />
                  </div>
                </div>
                
                
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $global['global_meta_description_en']['field_name'];?><span class="red">*</span></label>
                  <div class="col-sm-5">
                    <input type="text" id="<?php echo $global['global_meta_description_en']['field_key'];?>" name="<?php echo $global['global_meta_description_en']['field_key'];?>" placeholder="<?php echo $global['global_meta_description_en']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" value="<?php echo $global['global_meta_description_en']['field_value'];?>" />
                  </div>
                </div>
                
                
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $global['global_phone_number']['field_name'];?><span class="red">*</span></label>
                  <div class="col-sm-5">
                    <input type="text" id="<?php echo $global['global_phone_number']['field_key'];?>" name="<?php echo $global['global_phone_number']['field_key'];?>" placeholder="<?php echo $global['global_phone_number']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" value="<?php echo $global['global_phone_number']['field_value'];?>" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $global['global_site_email_address']['field_name'];?><span class="red">*</span></label>
                  <div class="col-sm-5">
                    <input type="text" id="<?php echo $global['global_site_email_address']['field_key'];?>" name="<?php echo $global['global_site_email_address']['field_key'];?>" placeholder="<?php echo $global['global_site_email_address']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" value="<?php echo $global['global_site_email_address']['field_value'];?>" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $global['global_site_address']['field_name'];?><span class="red">*</span></label>
                  <div class="col-sm-5">
                    <textarea id="<?php echo $global['global_site_address']['field_key'];?>" name="<?php echo $global['global_site_address']['field_key'];?>" placeholder="<?php echo $global['global_site_address']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" style="resize:none;" /><?php echo $global['global_site_address']['field_value'];?></textarea>
                  </div>
                </div>
                
                <h4><i class="fa fa-envelope blue"></i> Email Information</h4>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $global['global_web_admin_name']['field_name'];?><span class="red">*</span></label>
                  

                  <div class="col-sm-5">
                    <input type="text" id="<?php echo $global['global_web_admin_name']['field_key'];?>" name="<?php echo $global['global_web_admin_name']['field_key'];?>" placeholder="<?php echo $global['global_web_admin_name']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" value="<?php echo $global['global_web_admin_name']['field_value'];?>" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $global['global_webadmin_email']['field_name'];?><span class="red">*</span></label>
                  

                  <div class="col-sm-5">
                    <input type="text" id="<?php echo $global['global_webadmin_email']['field_key'];?>" name="<?php echo $global['global_webadmin_email']['field_key'];?>" placeholder="<?php echo $global['global_webadmin_email']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" value="<?php echo $global['global_webadmin_email']['field_value'];?>" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $global['global_email_signature']['field_name'];?><span class="red">*</span></label>
                  

                  <div class="col-sm-5">
                    <textarea id="<?php echo $global['global_email_signature']['field_key'];?>" name="<?php echo $global['global_email_signature']['field_key'];?>" placeholder="<?php echo $global['global_email_signature']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" style="resize:none;" /><?php echo $global['global_email_signature']['field_value'];?></textarea>
                  </div>
                </div>


                <!-- <h4><i class="fa fa-truck"></i> Delivery Area</h4> -->
                
                <!-- <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Kilometre Range <span class="red">*</span></label>
                  

                  <div class="col-sm-5">
                    <input type="text" id="<?php echo $global['global_web_with_in']['field_key'];?>" name="<?php echo $global['global_web_with_in']['field_key'];?>" placeholder="<?php echo $global['global_web_with_in']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" value="<?php echo $global['global_web_with_in']['field_value'];?>" />
                  </div>
                
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Latitude <span class="red">*</span></label>
                  

                  <div class="col-sm-5">
                    <input type="text" id="<?php echo $global['global_web_latitude']['field_key'];?>" name="<?php echo $global['global_web_latitude']['field_key'];?>" placeholder="<?php echo $global['global_web_latitude']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" value="<?php echo $global['global_web_latitude']['field_value'];?>" />
                  </div>
                
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Longitude <span class="red">*</span></label>
                  

                  <div class="col-sm-5">
                    <input type="text" id="<?php echo $global['global_web_longitude']['field_key'];?>" name="<?php echo $global['global_web_longitude']['field_key'];?>" placeholder="<?php echo $global['global_web_longitude']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" value="<?php echo $global['global_web_longitude']['field_value'];?>" />
                  </div>
                
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Multipale Pin <span class="red">*</span></label>
                  

                  <div class="col-sm-5">
                    <input type="text" id="<?php echo $global['global_web_with_in_pin']['field_key'];?>" name="<?php echo $global['global_web_with_in_pin']['field_key'];?>" placeholder="<?php echo $global['global_web_with_in_pin']['field_name'];?>" class="col-xs-10 col-sm-5 form-control" value="<?php echo $global['global_web_with_in_pin']['field_value'];?>" />
                    <span class="red">Pin Separate By Comma Like 700091,700092</span>
                  </div>
                
                </div>-->
                

                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              	<div class="col-sm-8">
                    <a class="btn btn-default pull-right" href="<?php echo $back_link; ?>">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
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
    $('#frm_global_settings').bootstrapValidator({
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
            global_site_name_en: {
                validators: {
                    notEmpty: {
                        message: 'Site Name is required and cannot be empty'
                    }
                }
            },
            global_meta_title_en: {
                validators: {
                    notEmpty: {
                        message: 'Global Meta Title is required and cannot be empty'
                    }
                }
            },
			global_meta_keywords_en: {
                validators: {
                    notEmpty: {
                        message: 'Global Meta Keywords is required and cannot be empty'
                    }
                }
            },
			global_meta_description_en: {
                validators: {
                    notEmpty: {
                        message: 'Global Meta Description is required and cannot be empty'
                    }
                }
            },
			global_phone_number: {
                validators: {
                    notEmpty: {
                        message: 'Phone Number is required and cannot be empty'
                    }
                }
            },
			global_site_email_address: {
                validators: {
                    notEmpty: {
                        message: 'Email Address is required and cannot be empty'
                    },
					emailAddress: {
						message: 'Email Address is invalid'
					}
                }
            },
			global_web_admin_name: {
                validators: {
                    notEmpty: {
                        message: 'Webadmin Name is required and cannot be empty'
                    }
                }
            },
			/*global_facebook_link: {
                validators: {
                    notEmpty: {
                        message: 'Facebook Link is required and cannot be empty'
                    }
                }
            },
			global_twitter_link: {
                validators: {
                    notEmpty: {
                        message: 'Twitter Link is required and cannot be empty'
                    }
                }
            },
			global_google_plus_link: {
                validators: {
                    notEmpty: {
                        message: 'Google Plus Link is required and cannot be empty'
                    }
                }
            },*/
			global_webadmin_email: {
                validators: {
                    notEmpty: {
                        message: 'Webadmin Email is required and cannot be empty'
                    },
					emailAddress: {
						message: 'Email Address is invalid'
					},
                }
            },
			global_site_address: {
                validators: {
                    notEmpty: {
                        message: 'Address is required and cannot be empty'
                    }
                }
            },
			global_footer_copyright_text: {
                validators: {
                    notEmpty: {
                        message: 'Footer Copyright Text is required and cannot be empty'
                    }
                }
            },
       /*global_web_with_in: {
                validators: {
                    notEmpty: {
                        message: 'Kilometre is required and cannot be empty'
                    },
                    between: {
                        min: 1,
                        max: 100000,
                        message: 'Delivery Kilometre must be between 1 and 100 Kilometre'
                    }
                }
            },

                global_web_longitude: {
                validators: {
                    notEmpty: {
                        message: 'Longitude is required and cannot be empty'
                    }
                }
            },

                    global_web_latitude: {
                validators: {
                    notEmpty: {
                        message: 'Longitude is required and cannot be empty'
                    }
                }
            },*/

            /*global_web_with_in_pin: {
                validators: {
                    notEmpty: {
                        message: 'Pin is required and cannot be empty'
                    },
                    /*between: {
                        min: 1,
                        max: 6,
                        message: 'Delivery Pin must be between 1 and 6 Code'
                    }*/
                /*}
            },*/

        },

        

    });
});

$(function () {
	$("#<?php echo $global['global_facebook_logo']['field_key'];?>").change(function () {
		if (typeof (FileReader) != "undefined") {
			var dvPreview = $("#dvPreview");
			dvPreview.html("");
			var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
			$($(this)[0].files).each(function () {
				var file = $(this);
				if (regex.test(file[0].name.toLowerCase())) {
					var reader = new FileReader();
					reader.onload = function (e) {
						var img = $("<img />");
						img.attr("style", "width: 75px");
						img.attr("src", e.target.result);
						img.attr("class", "img-thumbnail");
						dvPreview.append(img);
						dvPreview.append('<div style="margin-left: 70px; margin-top: -65px; padding-bottom: 69px;"><a href="javascript:void(0);" onclick="remove_image();"><i class="ace-icon fa fa-times-circle red"></i></a></div>');
						$("#<?php echo $global['global_facebook_logo']['field_key'];?>").attr('data-title',file[0].name);
						$("#hid_<?php echo $global['global_facebook_logo']['field_key'];?>").val(file[0].name);
					}
					reader.readAsDataURL(file[0]);
				} else {
					alert(file[0].name + " is not a valid image file.");
					dvPreview.html("");
					$('#<?php echo $global['global_facebook_logo']['field_key'];?>').val('');
					return false;
				}
			});
		} else {
			alert("This browser does not support HTML5 FileReader.");
		}
	});
});

function remove_image(){
	$('#dvPreview').html('');
	$('#<?php echo $global['global_facebook_logo']['field_key'];?>').val('');
	$('#hid_<?php echo $global['global_facebook_logo']['field_key'];?>').val('');
	$("#<?php echo $global['global_facebook_logo']['field_key'];?>_span").attr('data-title','No File...');
}

$(function () {
	$("#<?php echo $global['global_twitter_logo']['field_key'];?>").change(function () {
		if (typeof (FileReader) != "undefined") {
			var dvPreview = $("#dvPreview1");
			dvPreview.html("");
			var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
			$($(this)[0].files).each(function () {
				var file = $(this);
				if (regex.test(file[0].name.toLowerCase())) {
					var reader = new FileReader();
					reader.onload = function (e) {
						var img = $("<img />");
						img.attr("style", "width: 75px");
						img.attr("src", e.target.result);
						img.attr("class", "img-thumbnail");
						dvPreview.append(img);
						dvPreview.append('<div style="margin-left: 70px; margin-top: -65px; padding-bottom: 69px;"><a href="javascript:void(0);" onclick="remove_image1();"><i class="ace-icon fa fa-times-circle red"></i></a></div>');
						$("#<?php echo $global['global_twitter_logo']['field_key'];?>").attr('data-title',file[0].name);
						$("#hid_<?php echo $global['global_twitter_logo']['field_key'];?>").val(file[0].name);
					}
					reader.readAsDataURL(file[0]);
				} else {
					alert(file[0].name + " is not a valid image file.");
					dvPreview.html("");
					$('#<?php echo $global['global_twitter_logo']['field_key'];?>').val('');
					return false;
				}
			});
		} else {
			alert("This browser does not support HTML5 FileReader.");
		}
	});
});

function remove_image1(){
	$('#dvPreview1').html('');
	$('#<?php echo $global['global_twitter_logo']['field_key'];?>').val('');
	$('#hid_<?php echo $global['global_twitter_logo']['field_key'];?>').val('');
	$("#<?php echo $global['global_twitter_logo']['field_key'];?>_span").attr('data-title','No File...');
}

$(function () {
	$("#<?php echo $global['global_google_plus_logo']['field_key'];?>").change(function () {
		if (typeof (FileReader) != "undefined") {
			var dvPreview = $("#dvPreview2");
			dvPreview.html("");
			var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
			$($(this)[0].files).each(function () {
				var file = $(this);
				if (regex.test(file[0].name.toLowerCase())) {
					var reader = new FileReader();
					reader.onload = function (e) {
						var img = $("<img />");
						img.attr("style", "width: 75px");
						img.attr("src", e.target.result);
						img.attr("class", "img-thumbnail");
						dvPreview.append(img);
						dvPreview.append('<div style="margin-left: 70px; margin-top: -65px; padding-bottom: 69px;"><a href="javascript:void(0);" onclick="remove_image2();"><i class="ace-icon fa fa-times-circle red"></i></a></div>');
						$("#<?php echo $global['global_google_plus_logo']['field_key'];?>").attr('data-title',file[0].name);
						$("#hid_<?php echo $global['global_google_plus_logo']['field_key'];?>").val(file[0].name);
					}
					reader.readAsDataURL(file[0]);
				} else {
					alert(file[0].name + " is not a valid image file.");
					dvPreview.html("");
					$('#<?php echo $global['global_google_plus_logo']['field_key'];?>').val('');
					return false;
				}
			});
		} else {
			alert("This browser does not support HTML5 FileReader.");
		}
	});
});

function remove_image2(){
	$('#dvPreview2').html('');
	$('#<?php echo $global['global_google_plus_logo']['field_key'];?>').val('');
	$('#hid_<?php echo $global['global_google_plus_logo']['field_key'];?>').val('');
	$("#<?php echo $global['global_google_plus_logo']['field_key'];?>_span").attr('data-title','No File...');
}

$(function () {
	$("#<?php echo $global['global_linkedin_logo']['field_key'];?>").change(function () {
		if (typeof (FileReader) != "undefined") {
			var dvPreview = $("#dvPreview3");
			dvPreview.html("");
			var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
			$($(this)[0].files).each(function () {
				var file = $(this);
				if (regex.test(file[0].name.toLowerCase())) {
					var reader = new FileReader();
					reader.onload = function (e) {
						var img = $("<img />");
						img.attr("style", "width: 75px");
						img.attr("src", e.target.result);
						img.attr("class", "img-thumbnail");
						dvPreview.append(img);
						dvPreview.append('<div style="margin-left: 70px; margin-top: -65px; padding-bottom: 69px;"><a href="javascript:void(0);" onclick="remove_image3();"><i class="ace-icon fa fa-times-circle red"></i></a></div>');
						$("#<?php echo $global['global_linkedin_logo']['field_key'];?>").attr('data-title',file[0].name);
						$("#hid_<?php echo $global['global_linkedin_logo']['field_key'];?>").val(file[0].name);
					}
					reader.readAsDataURL(file[0]);
				} else {
					alert(file[0].name + " is not a valid image file.");
					dvPreview.html("");
					$('#<?php echo $global['global_linkedin_logo']['field_key'];?>').val('');
					return false;
				}
			});
		} else {
			alert("This browser does not support HTML5 FileReader.");
		}
	});
});

function remove_image3(){
	$('#dvPreview3').html('');
	$('#<?php echo $global['global_linkedin_logo']['field_key'];?>').val('');
	$('#hid_<?php echo $global['global_linkedin_logo']['field_key'];?>').val('');
	$("#<?php echo $global['global_linkedin_logo']['field_key'];?>_span").attr('data-title','No File...');
}

$(function () {
	$("#<?php echo $global['global_instagram_logo']['field_key'];?>").change(function () {
		if (typeof (FileReader) != "undefined") {
			var dvPreview = $("#dvPreview4");
			dvPreview.html("");
			var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
			$($(this)[0].files).each(function () {
				var file = $(this);
				if (regex.test(file[0].name.toLowerCase())) {
					var reader = new FileReader();
					reader.onload = function (e) {
						var img = $("<img />");
						img.attr("style", "width: 75px");
						img.attr("src", e.target.result);
						img.attr("class", "img-thumbnail");
						dvPreview.append(img);
						dvPreview.append('<div style="margin-left: 70px; margin-top: -65px; padding-bottom: 69px;"><a href="javascript:void(0);" onclick="remove_image4();"><i class="ace-icon fa fa-times-circle red"></i></a></div>');
						$("#<?php echo $global['global_instagram_logo']['field_key'];?>").attr('data-title',file[0].name);
						$("#hid_<?php echo $global['global_instagram_logo']['field_key'];?>").val(file[0].name);
					}
					reader.readAsDataURL(file[0]);
				} else {
					alert(file[0].name + " is not a valid image file.");
					dvPreview.html("");
					$('#<?php echo $global['global_instagram_logo']['field_key'];?>').val('');
					return false;
				}
			});
		} else {
			alert("This browser does not support HTML5 FileReader.");
		}
	});
});

function remove_image4(){
	$('#dvPreview4').html('');
	$('#<?php echo $global['global_instagram_logo']['field_key'];?>').val('');
	$('#hid_<?php echo $global['global_instagram_logo']['field_key'];?>').val('');
	$("#<?php echo $global['global_instagram_logo']['field_key'];?>_span").attr('data-title','No File...');
}
</script>

<?php $this->load->view('include/footer.php');?>