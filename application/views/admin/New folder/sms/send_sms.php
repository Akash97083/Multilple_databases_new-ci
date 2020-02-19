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
			<?php
      $succmsg = $this->input->get('sucess', TRUE);
       if($succmsg!=''){?>
                <div class="alert alert-success" id="sucess">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
						Message has been sent successfully.
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

           <div class="alert alert-danger alert-dismissable fade in" style="display: none;" id="error_msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                    <span id="error"></span>
                </div>

            </div>
           <div class="alert alert-success" id="response" style="display: none;"></div>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="frm_user" name="frm_user" method="post" action="<?php echo base_url('admin/user/sen_message/'); ?>" enctype="multipart/form-data">
              <div class="box-body">
                
              
             <div class="form-group" id="alluserselected">
             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">All User</label>
                  <div class="col-sm-5">
                    <input type="checkbox" id="allusers" name="allusers" value="" onclick="hidePerti()"/>
                  </div>
                </div>
              </div>
                
                
                <div class="form-group" id="perticularuserselected">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Perticular User</label>
                  <div class="col-sm-5">
                    <select class="tokenize-limit-demo1" multiple name="perticular[]" id="perticular">
                            <?php echo select_options(); ?>
                        </select>
                  </div>
                </div>
              </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Message</label>
                  <div class="col-sm-5">
                    <textarea name="address1" id="edit" placeholder="Address1" class="col-xs-10 col-sm-5 form-control" style="resize:none;"></textarea> 
                  </div>
                </div>
        <input type="hidden" name="user_id" value="<?php echo ($users_detail['id']?$users_detail['id'] : '');?>">
               
                
              </div>
              <!-- /.box-body -->
			  <?php $back_link = base_url('user'); ?>
              <div class="box-footer">
              	<div class="col-sm-8">
                 <a class="btn btn-default pull-right" href="#" style="margin-right:10px;">Cancel</a>
                    <button type="" class="btn btn-info pull-right" style="margin-right:10px;" onclick="sendmsg()">Submit</button>
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
$(function(){
      $('#edit').froalaEditor({
        toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|','color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat','paragraphFormat','align', 'formatOL', 'formatUL', 'outdent', 'indent','-', 'insertLink', 'insertImage', 'insertVideo','insertTable', '|','specialCharacters', 'insertHR', 'selectAll', 'clearFormatting', '|','html', '|', 'undo', 'redo'],
        //toolbarButtons: [],
        height: 200,
        charCounterMax: 160,
        //pastePlain: true,

      })
    });

$(document).ready(function() {
   $('.tokenize-limit-demo1').tokenize2({
      placeholder: "Type user name..."
  });

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
            user_name: {
                validators: {
                    notEmpty: {
                        message: 'Name is required and cannot be empty'
                    }
                }
            },
			
   	mobile: {
                validators: {
                    notEmpty: {
                        message: 'Mobile number is required and cannot be empty'
                    },
              stringLength: {
                        min: 10,
                        max: 10,
                        message: 'Mobile number must be 10 digit number'
                    },
				 integer: {
                        message: 'The value is not an integer'
                    },
				      },
            },
            
		
         }
    });
});

$('.tokenize-limit-demo1').on("tokenize:tokens:add", function (event, value, text){
     //console.log("Value is "+value); // To get value
     //console.log("Text is "+ text); // To get text
     $('#sucess').hide();
     $('#error_msg').hide();
     $('#alluserselected').hide();
});

function sendmsg(){
 var csrfToken = $('meta[name="csrf-token"]').attr("content");
 var allusers = $("#allusers").prop("checked") ? 1 : 0 ;
 
 var msg = $('#edit').val();

   if(allusers !='0'){
    var perticular = '<?php echo allActiveUserPhone();?>';
    
    }else{
    
    var perticular = $('.tokenize-limit-demo1').data('tokenize2').toArray().join(', ');

   }

   if(perticular==''){
    $('#sucess').hide();
    $('#error_msg').show();
    $('#error').html('Select at Least 1 User');
    return false;
   }else{

     $('#sucess').hide();
     $('#error_msg').hide();
     $('#error').html('');

   }

   if(msg==''){
     $('#sucess').hide();
     $('#error_msg').show();
     $('#error').html('Message is required and cannot be empty');
     return false;

   }

 var username1 = "vishal143.niit@gmail.com";
 var hash1 = "4e6cbd0355fcf433786b5bf71108986028682692e173c887370d12248759de7f";
 var sender1 = "JNKRTM";
 var numbers1 = perticular;
 var test1 = "0";

  var form_data = { 
      username: username1,
      hash: hash1,
      sender: sender1,
      numbers: numbers1,
      sms_message: msg,
      test:test1
      }

    $.ajax({
    url : '<?php echo base_url('admin/user/msgsend')?>',
    type : 'POST',
    data : {result : JSON.stringify(form_data)},
    //dataType : 'json',
    beforeSend : function(jqXHR, settings ){
      //alert(url);
    },
    success : function(data, textStatus, jqXHR){
       //alert(data);
      //$("#perticular").text('').trigger("change");
      //$("#addedit_user_frm")[0].reset();
      window.location.href = "<?php echo base_url('admin/user/sms?sucess=1')?>";
      
      
    },
    
    error : function(jqXHR, textStatus, errorThrown){
    }
  
    });



  /*});*/

  }

  function hidePerti (){
   var allusers = $("#allusers").prop("checked") ? 1 : 0 ;
   if(allusers=='1'){
      $('#sucess').hide();
      $('#perticularuserselected').hide();
      $('#error_msg').hide();

   }else{
      $('#sucess').hide();
      $('#perticularuserselected').show();

   }
    
}

</script>

<?php $this->load->view('include/footer.php');?>