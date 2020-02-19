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
            <form class="form-horizontal" id="frm_preferences" name="frm_user" method="POST" action="<?php echo base_url('admin/report/sms_data/'); ?>">
           <div class="gray-bg">

            <div class="col-md-12">
            <div class="col-md-3">
            <input type="text" id="to_date" name="to_date" placeholder="To Date" class="form-control" value="<?php echo $to_date;?>" />
            </div>
            <div class="col-md-3">
            <input type="text" id="from_date" name="from_date" placeholder="From Date" class="form-control" value="<?php echo $from_date;?>" />
            </div>
            <div class="col-md-3">
            <button type="submit" class="btn btn-info">Submit</button>
            </div>
            </div>
          </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL #</th>
                  <!-- <th>Image</th> -->
                  <th>Available Credits</th>
                  <th>Message</th>
                  <th>Action </th>
                  
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

                  <td><?php echo $recordset[$i]['available_credits']; ?></td>
                  <td><?php echo $recordset[$i]['sms_description']; ?></td>
                  <td><a class="btn btn-xs btn-info" href="#" title="SMS Detail" data-target="#myModal" data-toggle="modal" onclick="get_sale(<?php echo $recordset[$i]['id'];?>)"> <i class="fa fa-eye" aria-hidden="true"></i>
                  </a></td>
                  
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

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Sms Details</h4>
     </div>
    <div class="modal-body">
      
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </div>
      
    </div>
  </div>
  <!-- End Model-->
 
<script>
$(window).load(function(e) {
    $('#example1 th:nth-child(1)').removeClass('sorting').removeClass('no_sort sorting_asc').css('width','21px');
	$('#example1 th:nth-child(7)').removeClass('sorting').removeClass('no_sort sorting_asc');
});
 $(document).ready(function() {
   $('#to_date').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    yearRange: "-100:+10",
                    //minDate: '0d',
                    onSelect: function (date) {
                         $("#from_date").datepicker("option","minDate", date);
                    }


                });

    $('#from_date').datepicker({
                    changeMonth: true,
                    changeYear: true,
                   dateFormat: 'yy-mm-dd',
                   yearRange: "-100:+10",
                    //minDate: '0d',
                    onSelect: function (date) {
                      $("#to_date").datepicker("option","maxDate", date);  
                    }


                });


  });

function get_sale(id){
  //alert(id);
  $.ajax({
    url : '<?php echo base_url('admin/report/getSmsDetails'); ?>',
    type : 'POST',
    data : {id : id},
    //dataType : 'json',
    beforeSend : function(jqXHR, settings ){
      //alert(url);
    },
    success : function(data, textStatus, jqXHR){
      //alert(data);
      $('.modal-body').html(data);
      $("#detailsModal").modal("show");
    },
    /*complete : function(jqXHR, textStatus){
      alert(3);
    },*/
    error : function(jqXHR, textStatus, errorThrown){
    } 
  }); 
 }
</script>

<?php $this->load->view('include/footer.php');?>
