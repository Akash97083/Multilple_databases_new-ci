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
  
  <?php //print_r($page_title);?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">     
<?php
 if($this->session->flashdata('succmsg')): ?>
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">
      <i class="ace-icon fa fa-times"></i>
    </button>
     <?php echo $this->session->flashdata('succmsg');?>
    <br>
    </div>
<?php endif; ?>

       
        <div class="alert alert-danger" id="user_delete" style="display:none">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                        User Delete Successfully
                    <br>
                </div>
           
            <div class="box-header">
              <h3 class="box-title pull-right">
             <!-- <a class="btn btn-success btn-sm" href="<?php //echo base_url('admin/user/add_user'); ?>" title="Add User"> <i class="ace-icon fa glyphicon-plus white"></i> Add New </a> -->
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="manage_invoice" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL #</th>
                  <th>Invoice No</th>
                   <th>Booking Date</th>
                  <th>Awb No</th>
                  <th>Invoice Value</th>
                  <th>Consignee Code</th>
                  <th>Consignee Name</th>
                  <th>ConsigneeMobileNo</th>
                  <!-- <th>DeliveryStatus</th>
                  <th>UserName</th> -->
                  
                </tr>
                </thead>
                <tbody>
                 
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<script>
$(document).ready(function() {
    $('#manage_invoice').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":"<?php echo base_url().'admin/invoice/all_invoice';?>",
        "pageLength":25
    });
});

function change_status(id){
  
  if(confirm("Are you sure to change status of this record?"))
  {
    $.ajax({
      url : '<?php echo base_url(''); ?>',
      type : 'POST',
      data : 'id=' + id,
      //dataType : 'json',
      beforeSend : function(jqXHR, settings ){
        //alert(url);
      },
      success : function(data, textStatus, jqXHR){
        $('#cng_status'+id).removeClass('activebutton').removeClass('inactivebutton').addClass(data.toLowerCase()+'button');
        $('#cng_status'+id).html(data);
      },
      /*complete : function(jqXHR, textStatus){
        alert(3);
      },*/
      error : function(jqXHR, textStatus, errorThrown){
      }
    });
  }
}

function delete_user(id,editID){
  if(confirm("Are you sure to delete of this User ?"))
  {
    $.ajax({
      url : '<?php echo base_url('user/user_delete/'); ?>',
      type : 'POST',
      data : 'id=' + id,
      //dataType : 'json',
      beforeSend : function(jqXHR, settings ){
        //alert(url);
      },
      success : function(data, textStatus, jqXHR){
        //alert(data);
        
        $('#tr'+id).slideUp("slow", function() { $('#tr'+id).remove();});
        $("#user_delete").show();
      },
      /*complete : function(jqXHR, textStatus){
        alert(3);
      },*/
      error : function(jqXHR, textStatus, errorThrown){
      }
    });
  }
}


</script>

<?php $this->load->view('include/footer.php');?>
