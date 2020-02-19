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

            <!-- Distrbuter-->
              <div class="row">
                <div class="col-md-6">
                  
                            <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">Invoice Number</label>
                              <div class="col-sm-9">
                                <input type="text" id="" name="invoice_number" placeholder="Invoice Number" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($InvoiceDetail['invoiceno']?$InvoiceDetail['invoiceno'] : '');?>" readonly="">
                              </div>
                            </div>

                            <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">Awn No</label>
                              <div class="col-sm-9">
                                <input type="text" id="" name="invoice_number" placeholder="Invoice Number" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($InvoiceDetail['awbno']?$InvoiceDetail['awbno'] : '');?>" readonly="">
                              </div>
                            </div>
                            <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">Transport/Courier/Local</label>
                              <div class="col-sm-9">
                                <input type="text" id="" name="invoice_number" placeholder="Invoice Number" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($InvoiceDetail['transport/courier/local']?$InvoiceDetail['transport/courier/local'] : '');?>" readonly="">
                              </div>
                            </div>
                            <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">Consignor</label>
                              <div class="col-sm-9">
                                <input type="text" id="" name="consignor" placeholder="Invoice Number" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($InvoiceDetail['consignor']?$InvoiceDetail['consignor'] : '');?>" readonly="">
                              </div>
                            </div>
                            <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">Consignee</label>
                              <div class="col-sm-9">
                                <input type="text" id="" name="Consignee" placeholder="Consignee" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($InvoiceDetail['consignee']?$InvoiceDetail['consignee'] : '');?>" readonly="">
                              </div>
                            </div>
                            <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">Consignee Mobileno</label>
                              <div class="col-sm-9">
                                <input type="text" id="" name="consigneemobileno" placeholder="consigneemobileno" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($InvoiceDetail['consigneemobileno']?$InvoiceDetail['consigneemobileno'] : '');?>" readonly="">
                              </div>
                            </div>
                            <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">Actual Weight</label>
                              <div class="col-sm-9">
                                <input type="text" id="" name="actualweight" placeholder="Actual Weight" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($InvoiceDetail['actualweight']?$InvoiceDetail['actualweight'] : '');?>" readonly="">
                              </div>
                            </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">Boking date</label>
                              <div class="col-sm-9">
                                <input type="text" id="" name="boking_date" placeholder="Boking date" class="col-xs-10 col-sm-5 form-control" value="<?php echo date('d-m-y',strtotime($InvoiceDetail['bookingdate'])); ?>" readonly="">
                              </div>
                  </div>
                  <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">Invoice Value</label>
                              <div class="col-sm-9">
                                <input type="text" id="" name="boking_date" placeholder="Boking date" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($InvoiceDetail['invoicevalue']?$InvoiceDetail['invoicevalue'] : '');?>" readonly="">
                              </div>
                  </div>

                  <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">Origin</label>
                              <div class="col-sm-9">
                                <input type="text" id="" name="invoice_number" placeholder="Invoice Number" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($InvoiceDetail['origin']?$InvoiceDetail['origin'] : '');?>" readonly="">
                              </div>
                  </div>
                  <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">ConsigneeCode</label>
                              <div class="col-sm-9">
                                <input type="text" id="" name="invoice_number" placeholder="ConsigneeCode" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($InvoiceDetail['consigneecode']?$InvoiceDetail['consigneecode'] : '');?>" readonly="">
                              </div>
                  </div>
                  <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">ConsigneeAddress</label>
                              <div class="col-sm-9">
                                <textarea name="consigneeaddress" placeholder="consigneeaddress" class="col-xs-10 col-sm-5 form-control" readonly=""><?php echo ($InvoiceDetail['consigneeaddress']?$InvoiceDetail['consigneeaddress'] : '');?></textarea>
                              </div>
                  </div>
                  <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">Packages</label>
                              <div class="col-sm-9">
                                <input type="text" id="" name="packages" placeholder="ConsigneeCode" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($InvoiceDetail['packages']?$InvoiceDetail['packages'] : '');?>" readonly="">
                              </div>
                  </div>
                  <div class="form-group has-feedback">
                              <label for="inputEmail3" class="col-sm-3 control-label">Charged Weight</label>
                              <div class="col-sm-9">
                                <input type="text" id="" name="chargedweight" placeholder="Charged Weight" class="col-xs-10 col-sm-5 form-control" value="<?php echo ($InvoiceDetail['chargedweight']?$InvoiceDetail['chargedweight'] : '');?>" readonly="">
                              </div>
                  </div>
                          
                </div>
              </div>
           <!--End Disteribuer Detail-->
           <div class="col-xs-12">
              <?php if($this->session->flashdata('succmsg')):?>
              <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">
              <i class="ace-icon fa fa-times"></i>
              </button>
              <?php echo $this->session->flashdata('succmsg');?>
              <br>
              </div>
              <?php endif; ?>
            </div>

      <!-- Main Table Section -->
      <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL #</th>
                  <th>Invoice No</th>
                  <th>UserName</th>
                  <th>Last Location</th>
                  <th>Other Note</th>
                  <th>DateTime</th>
                  <th>Delivery Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 <?php
        if($recordset)
        {
        //print_r($recordset);
        $startRecord ='0';
        $i = '1';
          foreach($recordset as $row)
          {
            $location_id = perticularFlied('tbl_user','location_id',array('id'=>$row['user_id']))[0];
            $location_address = perticularFlied('tbl_location','address',array('id'=>$location_id['location_id']))[0];

        ?>
                <tr id="tr<?php echo $row['id']; ?>">
                  <td><?php echo $i; ?></td>
                 
                  <td><?php echo $row['invoiceno'];?></td>
                  <td><?php
                 $user = perticularFlied('tbl_user','full_name',array('id'=>$row['user_id']))[0];
                  echo $user['full_name'];
                   ?></td>
                  
                  <td><?php echo $location_address['address']; ?></td>
                  <td><?php echo $row['other_note']; ?></td>
                  <td><?php if($row['update_at'] !=''){
                    echo date('d-m-y H:i:s',strtotime($row['update_at']));

                  }?></td>
                  <td><?php echo ($row['deliverystatus']=='Out_for_Delivery'?'Out for Delivery':$row['deliverystatus']); ?></td>
                  <td>
                  <a class="btn btn-xs btn-info" href="javascript:void(0)" title="Edit Delivery" data-toggle="modal" data-target="#updateDelivery" onclick="getDetail('<?php echo $row['id'];?>')"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                  </td>
                  
                 </tr>
                <?php
                $i++;
          }
        }
        else
        {
        ?>
                <tr>
                  <td colspan="8">No Records Found</td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      
    
      <!-- End Main Section -->
              
          </div>
          <!-- /.box -->

        </div>



      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

  </div>


  <!-- Update updateDelivery Model -->
  <div class="modal fade" id="updateDelivery" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Delivery Status </h4>
        </div>
        <div class="modal-body">

          <form class="form-horizontal" id="frm_update_delivery" name="order_confirm" method="post" action="<?php echo base_url('admin/invoice/invoice_delivery_data/');?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select Delivery<span class="red">*</span></label>
                  <div class="col-sm-9">
                    <div id="deliverystatusData">
                      
                    </div>
                    
                  </div>
                  
              </div>
              <div class="form-group" style="display:none" id="div_other_note">
                  <label for="inputEmail3" class="col-sm-3 control-label">Other Note</label>
                  <div class="col-sm-6">
                    <textarea name="other_note" id="other_note" placeholder="Other Note" class="col-xs-5 col-sm-5 form-control"/></textarea>
                  </div>
              </div>

              
              <input type="hidden" name="invoice_number" id="url_invoice_number" value="<?php echo $this->uri->segment('4');?>">
              <input type="hidden" name="invoice_id" id="invoice_id">
              

              <div class="box-footer">
                <div class="col-sm-8">
                   <button type="submit" class="btn btn-info pull-right" style="margin-right:10px;">Submit</button>
                  </div>
              </div>
           

      </div>
    </form>
          


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- End Update updateDelivery Model -->


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
          
         }
    });
});

function chk_email(val){
 var id ='<?php echo ($UserDetail['id']?$UserDetail['id'] : '');?>';
 var v_error     = '1px solid #f32517';
 var v_ok        = '1px solid green';
 $.ajax({
    type:"POST",
    url:'<?php echo base_url('admin/user/email_check');?>',
    data:{'id':id,'email_id':val},
    success: function(data){
      if(data==1)
        { 
          //$("#name").val('');
           $("#name").css('border',v_error);
           $('#email_error').show();   
          $('#email_error').html("User Email already exists").slideDown(1000);
          $('#sub').prop('disabled',true);
          return false; 
           }else{
          $("#email_id").css('border',v_ok);
          $('#email_error').slideUp(1000);
          $('#sub').prop('disabled',false);
        }
    }
 });
}

function getDetail(id){
  $('#invoice_id').val(id);
   var url_invoice_number = $('#url_invoice_number').val();
  $.ajax({
      url : '<?php echo base_url('admin/invoice/delivery_status/'); ?>',
      type : 'POST',
      data : {'id':id},
      beforeSend : function(jqXHR, settings ){
        
      },
      success : function(data, textStatus, jqXHR){
        
        $('#deliverystatusData').html(data);
        check_other_box(id);
      },
      
      error : function(jqXHR, textStatus, errorThrown){
      }
  });

}

function check_other_box(id){
  $.ajax({
   type :"POST",
   url: '<?php echo base_url('admin/invoice/get_delivery_value/'); ?>',
   data : {'id':id},
   success : function(data){
    var obj = JSON.parse(data);
    if(obj.val =='1'){
      $('#div_other_note').show();
      $('#other_note').html(obj.other_note);
     }else{
      $('#div_other_note').hide();
     }
        
        
   }

  });
}

function select_other(id){
  if(id=='Others'){
    $('#div_other_note').show();
    
  }else{
    $('#div_other_note').hide();

  }
  
 }


</script>

<?php $this->load->view('include/footer.php');?>