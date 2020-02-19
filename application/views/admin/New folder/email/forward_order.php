<html lang="en">
<head>
  <title>Forward Order</title>
</head>

<body>
<div style="background-color:#ffffff">
<div style="margin: 0 auto; padding: 30px 15px; width: 70%;">
    <h3>
    <?php if($orderData['vendor_name'] !=''){
      echo "Dear ".$orderData['vendor_name'];

    }else{?>
      Dear (--Vendor Name --),
    <?php }?>

    </h3>
     
    <h3>Please process the Order no <?php echo $orderData['oder_no'];?></h3><br>
    <h5>Below are the detail of the order to be processed </h5>

    <br>
    <br>
    <?php //print_r();?>
    
    <table class="table">
      <thead>
        <th style="text-align: center;">Order No: <?php echo $orderData['oder_no']; ?></th>
        <th></th>
        <th style="text-align: center;">Delivery Date: <?php echo date('d-m-Y',strtotime($orderData['delivery_date']));?></th> 
      </thead>
      <tbody>
        <?php 
         $orderDetailData = perticularFlied('tbl_order_detail','*',array('order_id'=>$orderData['id']));
        if($orderDetailData)
        { 
          $startRecord ='0';
          $total = '0';
          $i = '1';
          foreach($orderDetailData as $row)
          {
            if($row['category_id'] !=''){

            $oreder_id = $row['order_id'];
            $total += $row['sub_total_amount'];

            $item_name = perticularFlied('tbl_item','item_name,item_code','item_image',array('category_id'=>$row['category_id'],'sub_cat_id'=>$row['sub_cat_id'],'id'=>$row['item_id']))[0];

          ?>
        <tr>

          <td style="text-align: center;">
            <img src="http://localhost/saesha_flower/img.php?img=item_image/1_1505197156_432.jpg&amp;mode=cm&amp;w=60&amp;h=60" alt="Photo" />
          </td>
          <td style="text-align: center;">
            Product ID #<?php echo $row['item_id'];?>
            <br/>
            <span style="font-size: 11px;"><?php echo $row['qty_type_description'];?>
            </span>
            <p><b><?php echo $row['glass_vase'].'  ';?></b>Glass Vase</p>
            </td>
          <td style="text-align: center;"><?php echo $row['quantity'];?>Pc(s)</td>

        </tr>
        <?php 
       $i++;
      } 

    }

    }?>
        
      </tbody>
      

    </table>

   <hr>
   <?php 
   $odeder_data = perticularFlied('tbl_order','delivery_date,order_date_time',array('id'=>$oreder_id))[0];
   $shipping_id = perticularFlied('tbl_order','shipping_id,delivery_charged_id',array('id'=>$oreder_id))[0];
   $shipping_data = perticularFlied('tbl_shipping','*',array('id'=>$shipping_id['shipping_id']))[0];
   
   $delivery_time = perticularFlied('tbl_delivery_charges','*',array('id'=>$shipping_id['delivery_charged_id']))[0];
   

   ?>
   <h3>Delivery Information</h3>
      Recipient Name :&nbsp;<?php echo $shipping_data['receiver_name'];?><br>
      Date Ordered :&nbsp;<?php echo date('d-m-Y',strtotime($odeder_data['delivery_date']));?> <br>
      Delivery Date:&nbsp;<?php echo date('d-m-Y',strtotime($odeder_data['order_date_time']));?><br>
      Delivety Time :<?php echo $delivery_time['from_time'] .'-'.$delivery_time['to_time'];?><br>
      Delivery Adderss: <?php echo $shipping_data['receiver_address'];?><br>
      Email: <?php echo $shipping_data['email'];?><br>
      Mob: <?php echo $shipping_data['receiver_mobile'];?><br>
    <h3>Delivery address :</h3>
    <?php echo $shipping_data['receiver_address'];?>
      

      <h3>Git Message</h3>
      <?php echo $shipping_data['message_on_card'];?> <br>

      Signature :<?php echo $shipping_data['signature'];?><br>

      <hr>
  With Regards,<br>
  Team Saesha Flower
</div>
</div>


</body>