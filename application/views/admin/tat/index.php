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
                        Item Delete Successfully
                    <br>
                </div>
           
            <div class="box-header">
              <h3 class="box-title pull-right">
              
            <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/tat/add_new_tat_excel'); ?>"> <i class="ace-icon fa glyphicon-plus white" title="Add Item"></i> Upload Excel</a>
             
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL #</th>
                  <th>Consignee Address</th>
                  <th>Type</th>
                  <th>Local</th>
                  <th>DELV. TAT-TRNSPORT</th>
                  <th>DELV. TAT-COURIER</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 <?php
				if($recordset)
				{
				//echo "<pre>";print_r($recordset);
				$startRecord ='0';
				$i = '1';
					foreach($recordset as $row)
					{
						$editLink = base_url('admin/tat/add_tat/').$row['id'];
				?>
                <tr id="tr<?php echo $row['id']; ?>">
                  <td><?php echo $i; ?></td>
                   <td><?php echo $row['consignee_address']; ?></td>
                   <td><?php echo $row['type']; ?></td>
                  <td><?php echo $row['local']; ?></td>
                  <td><?php echo $row['delivery_tat_trnsport']; ?></td>
                  <td><?php echo $row['delivery_tat_courier']; ?></td>
                  <td><a href="javascript:void(0);" onclick="change_status('<?php echo $row['id']; ?>');" id="cng_status<?php echo $row['id']; ?>" class="<?php echo ($row['status']=='Active')?'activebutton':'inactivebutton';?>"><?php echo ($row['status']=='Active')?'Active':'Inactive';?></a>
                  </td>

                  <td>
                  <a class="btn btn-xs btn-info" href="<?php echo $editLink;?>" title="Edit Costomer"><i class="ace-icon fa fa-pencil bigger-120"></i> </a> 
                 
                 <!-- <a class="btn btn-xs btn-danger" href="javascript:void(0);" title="Delete Item" onclick="delete_user('<?php //echo $row['id']; ?>');"> <i class="ace-icon fa fa-trash-o bigger-120"></i> </a> -->
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
			url : '<?php echo base_url('admin/tat/changestatus/'); ?>',
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
			url : '<?php echo base_url('admin/item/item_delete/'); ?>',
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

function prie_percentage(id,val){
  //alert(id);
  //alert(val);
  if($.isNumeric(val)){
      if(val.length <=2){
       $.ajax({
          type:'POST',
          url:'<?php echo base_url('admin/item/price_percentage');?>',
          data:{item_id:id,value:val},
          success:function(data){
            $('#error'+id).html('');
            $('#error'+id).html("Item price update as per price percentage");
           
          }


       });

      }else{
        $('#prie_percentage'+id).val('');
        $('#error'+id).html("Only 2 Digit Number Are Allowed");

      }
  }else{
    $('#prie_percentage'+id).val('');
    $('#error'+id).html("Only Number Are Allowed");

  }

}
</script>

<?php $this->load->view('include/footer.php');?>
