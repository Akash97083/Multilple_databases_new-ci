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
              
            <!-- <a class="btn btn-success btn-sm" href="<?php //echo base_url('admin/category/add_category'); ?>"> <i class="ace-icon fa glyphicon-plus white" title="Add User"></i> Add New </a> -->
             
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL #</th>
                  <th>Order No</th>
                  <th>Invoice No</th>
                  <th>Delivery Date</th>
                  <th>Receiver Name</th>
                  <th>Order Amount</th>
                  <th>Order Status</th>
                  <th>Payment Method</th>
                  
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
						$editLink = base_url('admin/order/add_order/').$row['id'];

            $receiver_name = perticularFlied('tbl_shipping','receiver_name',array('id'=>$row['shipping_id']))[0];
            $city_name = perticularFlied('tbl_city','city_name',array('id'=>$row['city_id']))[0];
				?>
                <tr id="tr<?php echo $row['id']; ?>">

                  <td><?php echo $i; ?></td>
                  <td><a href="<?php echo $editLink;?>" title="Order Detail"><?php echo $row['oder_no']; ?></a></td>
                  <td><?php echo $row['invoice_no']; ?></td>
                  <td><?php echo date('d-M-Y',strtotime($row['delivery_date'])); ?></td>

                  <td>
                    <?php echo '<center>'.$receiver_name['receiver_name'].'<br><p style="color:red;">'.ucfirst($city_name['city_name']).'</p></center>'; ?></td>

                  <td><?php echo $row['order_amount']; ?></td>
                  <td><?php
                   echo ($row['order_status']=='pending'?'<b><p style="color:red;">Pending</p></b>':''); 
                   echo ($row['order_status']=='payment_due'?'<b><p style="color:red;">Payment Due</p></b>':''); 

                   echo ($row['order_status']=='delivered'?'<b><p style="color:blue;">Delivered</p></b>':'');

                   echo ($row['order_status']=='confirm'?'<b><p style="color:green;">Confirm</p></b>':'');

                   echo ($row['order_status']=='canceled'?'<b><p style="color:red;">Canceled</p></b>':'');

                   ?></td>
                  <td>
                    <?php
                    if($row['payment_status']=='not_received'){

                     echo '<b><center style="color:red;">'.ucfirst($row['payment_method_name']).'<br>'.ucfirst($row['payment_status']=='not_received'?'Due':'').'</center></b>'; 
                    }

                    if($row['payment_status']=='received'){

                     echo '<b><center style="color:blue;">'.ucfirst($row['payment_method_name']).'<br>'.ucfirst($row['payment_status']=='received'?'Received':'').'</center></b>'; 
                    }

                    ?>
                      
                    </td>
                    }
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
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<script>
$(window).load(function(e) {
    $('#example1 th:nth-child(1)').removeClass('sorting').removeClass('no_sort sorting_asc').css('width','21px');
	$('#example1 th:nth-child(7)').removeClass('sorting').removeClass('no_sort sorting_asc');
});

function change_status(id){
	
	if(confirm("Are you sure to change status of this record?"))
	{
		$.ajax({
			url : '<?php echo base_url('admin/category/changestatus/'); ?>',
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
