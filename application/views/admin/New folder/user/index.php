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
          
            
            
		   
		    <div class="alert alert-danger" id="user_delete" style="display:none">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                        User Delete Successfully
                    <br>
                </div>
           
            <div class="box-header">
              <h3 class="box-title pull-right">
              <?php //if(get_permission('17','is_view') == '1'){ ?>
              	<!--<a class="btn bg-purple btn-sm" href="<?php // echo base_url('staff/export'); ?>"> <i class="ace-icon fa fa-upload white" title="Export to Excel"></i> Export to Excel </a>-->
              <?php //} ?>
              <?php //if(get_permission('17','is_add') == '1'){ ?>
              	<a class="btn btn-success btn-sm" href="<?php echo base_url('admin/user/add_user'); ?>"> <i class="ace-icon fa glyphicon-plus white" title="Add User"></i> Add New </a>
              <?php //} ?>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL #</th>
                  <!-- <th>Image</th> -->
                  <th>Name</th>
                  <th>Email Address</th>
                  <th>Mobile No.</th>
				         <th>Group</th>
                 <!-- <th>Branch Name</th> -->
                  <th>Status</th>
                  <?php if(get_permission('17','is_edit') == '1' || get_permission('17','is_delete') == '1' || get_permission('17','is_view') == '1'){ ?>
                  	<th>Action</th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>
                 <?php
				if($recordset)
				{
				//print_r($recordset);
				$startRecord ='0';
				
					for($i=0; $i<count($recordset); $i++)
					{
						//$editLink = str_replace("{{ID}}",$recordset[$i]['id'],$edit_link);
						//$deleteLink = str_replace("{{ID}}",$recordset[$i]['id'],$delete_link);
						//$activeLink = str_replace("{{ID}}",$recordset[$i]['id'],$active_link);
						$editLink = base_url('admin/user/add_user/').$recordset[$i]['id'];
				?>
                <tr id="tr<?php echo $recordset[$i]['id']; ?>">
                  <td><?php echo $i+$startRecord+1; ?></td>
                 <?php 
                 $img_thum = $this->config->config["file_upload_base_url"]."user_images/";
                 $img_noimage = $this->config->config["file_upload_base_url"]."user_images/no_image/No-image-found.jpeg";
                 if($recordset[$i]['image']!=''){
                 $img = $img_thum.$recordset[$i]['image'];

                 }else{
                  $img = $img_noimage;

                 }
                 ?>
                  <!-- <td><img src='<?php //echo $img;?>' width='50' height='50'></td> -->
                  <td><?php echo $recordset[$i]['user_name']; ?></td>
                  <td><?php echo $recordset[$i]['email_id']; ?></td>
                  <td><?php if($recordset[$i]['phoneno']!=''){ echo $recordset[$i]['phoneno']; }else{ echo 'N/A'; } ?></td>
				   <td><?php if($recordset[$i]['user_group']!=''){
				   if($recordset[$i]['user_group']=='1'){
				   echo "Customer";
				   }
				   if($recordset[$i]['user_group']=='2'){
				   echo "Cook";
				   }
				   if($recordset[$i]['user_group']=='3'){
				   echo "Delivery Boy";
				   }
            } ?>
				   
           </td>

            <td><a href="javascript:void(0);" onclick="change_status('<?php echo $recordset[$i]['id']; ?>');" id="cng_status<?php echo $recordset[$i]['id']; ?>" class="<?php echo ($recordset[$i]['status']=='Active')?'activebutton':'inactivebutton';?>"><?php echo ($recordset[$i]['status']=='Active')?'Active':'Inactive';?></a></td>
        <?php if(get_permission('17','is_edit') == '1' || get_permission('17','is_delete') == '1' || get_permission('17','is_view') == '1'){ ?>

                  <td>
                  <?php if(get_permission('17','is_edit') == '1'){ ?>
                  	<a class="btn btn-xs btn-info" href="<?php echo $editLink;?>" title="Edit User"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a> 
                  <?php } ?>
                  <?php if(get_permission('17','is_delete') == '1'){ ?>
                  	<a class="btn btn-xs btn-danger" href="javascript:void(0);" title="Delete User" onclick="delete_user('<?php echo $recordset[$i]['id']; ?>');"> <i class="ace-icon fa fa-trash-o bigger-120"></i> </a>
                  <?php } ?>
                 
                  </td>
                <?php } ?>   
                </tr>
                <?php
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
			url : '<?php echo base_url('admin/user/changestatus/'); ?>',
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
			url : '<?php echo base_url('admin/user/user_delete/'); ?>',
			type : 'POST',
			data : 'id=' + id,
			//dataType : 'json',
			beforeSend : function(jqXHR, settings ){
				//alert(url);
			},
			success : function(data, textStatus, jqXHR){
				alert(data);
				
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
