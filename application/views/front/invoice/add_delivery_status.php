<?php $this->load->view('front/include/meta.php');?>
<?php $this->load->view('front/include/header.php');?>
<!--sidebar-->
<?php $this->load->view('front/include/sidebar.php');?>
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

            <?php //print_r($UserDetail); ?>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="frm_user" name="frm_user" method="post" action="<?php echo base_url('user_invoice/user_invoice_status_data/'); ?>" enctype="multipart/form-data">
              <div class="box-body">
                
              
             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select Delivery<span class="red">*</span></label>

                  <div class="col-sm-9">
                    <select class="control-label" name="delivery_id" onchange="select_other(this.value)">
                      <option value="">Choose Delivery Status</option>
                      <option value="Out_for_Delivery">Out for Delivery</option>
                      <option value="Delivered">Delivered</option>
                      <option value="Dispatched">Dispatched</option>
                      <option value="Others">Others</option>
                     </select>
                  </div>
              </div>

              <div class="form-group" style="display:none" id="div_other_note">
                  <label for="inputEmail3" class="col-sm-3 control-label">Other Note</label>
                  <div class="col-sm-6">
                    <textarea name="other_note" id="other_note" placeholder="Other Note" class="col-xs-5 col-sm-5 form-control"/></textarea>
                     
                  </div>
                </div>
              <input type="hidden" name="invoice_no" value="<?php echo ($InvoiceDetail['invoiceno']?$InvoiceDetail['invoiceno'] : '');?>">


                
               
                
              </div>
              <!-- /.box-body -->
			  <?php $back_link = base_url('user_invoice'); ?>
              <div class="box-footer">
              	<div class="col-sm-12">
                  <a class="btn btn-default pull-right" href="<?php echo $back_link; ?>" style="margin-right:10px;">Cancel</a>
                  <button type="submit" class="btn btn-info pull-right" style="margin-right:10px;" id="sub">Submit</button>
                  </div>
              </div>
              <!-- /.box-footer -->
            </form>

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
                    echo date('d-m-y H:i:s A',strtotime($row['update_at']));

                  }?></td>
                  <td><?php echo ($row['deliverystatus']=='Out_for_Delivery'?'Out for Delivery':$row['deliverystatus']); ?></td>
                  
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
<script>
  
   CKEDITOR.replace( '',{
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
           delivery_id: {
                validators: {
                    notEmpty: {
                        message: 'Delivery is required and cannot be empty'
                    }
                }
            },
          }
    });
});

function select_other(id){
  if(id=='Others'){
    $('#div_other_note').show();
    
  }else{
    $('#div_other_note').hide();

  }
  


}

</script>

<?php $this->load->view('front/include/footer.php');?>