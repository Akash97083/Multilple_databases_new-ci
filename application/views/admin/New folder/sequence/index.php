<?php $this->load->view('include/meta.php');?>
<?php $this->load->view('include/header.php');?>
<!--sidebar-->
<?php $this->load->view('include/sidebar.php');?>

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 

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

		   <?php if(!empty($this->session->flashdata('message'))){ ?>
    <div class="alert alert-success" id="MSG">
      <?php echo $this->session->flashdata('message'); ?>
    </div>
  <?php } ?>
           
            <div class="box-header">
              <h3 class="box-title pull-right">
             </h3>

              <form class="form-horizontal" id="frm_user" name="frm_user" method="POST" action="<?php echo base_url('admin/sequence/get_all_Item/'); ?>">
           <div class="gray-bg">
            <div class="col-md-4">
              <div class="form-group">
            <select name ="category_id" id="category_id" class="form-control" onchange="select_sub_cat(this.value);">
                          <option value="">Select Category </option>
                          <?php 
                          foreach($getAllcategory as $key=> $row){
                          if($row['id'] == $post_category){

                          $selected = 'selected';

                          }else{
                          $selected = '';

                          }?>
                          <option value="<?php echo $row['id'];?>" <?php echo $selected;?>><?php echo $row['category_name'];?></option>
                          <?php }

                          ?>

                </select>
            </div>
          </div>

           <div class="col-md-1"></div>
            
            <div class="col-md-4">
              <div class="form-group">
              <select name ="sub_category_id" id="sub_category_id" class="form-control">
              <option value="">Select Sub  category </option>
              </select>
            
            </div>
          </div>
            
            <div class="col-md-3">
            <button type="submit" class="btn btn-info">Submit</button>
            </div>
            </div>
          </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table width="100%">
                <thead>
                </thead>
              
              <tbody class="row_position">

              <?php foreach($item as $row): ?>
                <tr id="<?php echo $row['id'];?>" style="float: left;">
                  <td style="padding: 10px;">
                    <img src="<?php echo base_url().'img.php?img=item_image/'.$row['item_image'];?>&amp;mode=cm&amp;w=150&amp;h=150"><br/><p style="margin: 10px 0 2px 0;"><b><?php echo '$ '.$row['item_price'].'</b></p><p>';?><?php echo $row['item_name'].'</p><br>';?>
                  </td>
                </tr>

            <?php endforeach;?>

            </table>

            </tbody>
                
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
<script type="text/javascript">
  $(document).ready( function () {
    select_sub_cat('');
      $('#MSG').slideUp(3500);
    });

    $( ".row_position" ).sortable({
      stop: function() {
      var selectedData = new Array();

              

            $('.row_position>tr').each(function() {

                selectedData.push($(this).attr("id"));

            });

            //alert(selectedData);
            updateOrder(selectedData);

        }

    });


    function updateOrder(data) {

        $.ajax({
            url:"<?php echo base_url('admin/sequence/updateItemSequence');?>",
            type:'post',
            data:{position:data},
            success:function(result){
              window.location.reload();
            }

        })

    }

</script>

<script>
function select_sub_cat(val){
  var id ='<?php echo ($post_sub_category?$post_sub_category:'');?>';
  $.ajax({
    method:'POST',
    url:'<?php echo base_url('admin/sequence/selected_sub_cat');?>',
    data:{'category_id':val,'sub_cat_id':id},
    success:function(data){
      //alert(data);
      $('#sub_category_id').html(data).trigger('chosen:updated');

    }
  });
}
</script>

<?php $this->load->view('include/footer.php');?>
