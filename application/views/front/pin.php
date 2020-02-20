<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Pin</title>
  <link rel="icon" href="<?php ?>img/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'webadmin/public/';?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'webadmin/public/';  ?>css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url().'webadmin/public/';?>plugins/iCheck/square/blue.css">
  
  <link rel="stylesheet" href="<?php echo base_url().'webadmin/public/'; ?>css/bootstrapValidator.min.css"/>
  
  <link rel="stylesheet" href="<?php echo base_url().'webadmin/public/'; ?>css/custom_style.css"/>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url().'webadmin/public/'; ?>js/jquery.2.1.1.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url().'webadmin/public/'; ?>bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'webadmin/public/'; ?>js/bootstrapValidator.min.js"> </script>
</head>
<body class="hold-transition login-page">


<div class="login-box">
  <div class="login-logo">
    <a href=""><img src="<?php echo base_url().'webadmin/public/';?>img/logo2\3.png"  /></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>



    <?php if($this->session->flashdata('errmsg')){?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                       <?php echo $this->session->flashdata('errmsg');?>
                    <br>
                </div>
                <?php } ?>

    <form action="<?php echo base_url('user/do_pin/'); ?>" method="post" id="login_form" name="login_form">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="YOUR PIN" name="pin" id="pin">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


  </div>
  <!-- /.login-box-body -->
</div>

<script type="application/javascript">
$(document).ready(function() {
    $('#login_form').bootstrapValidator({
  		framework: 'bootstrap',
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
            pin: {
                validators: {
                    notEmpty: {
                        message: 'PIN is required and cannot be empty'
                    }
                }
            },
           
        }
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(e) {
    $('#username').focus();
});
</script>


<!-- iCheck -->
<script src="<?php echo base_url().'webadmin/public/';?>plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>