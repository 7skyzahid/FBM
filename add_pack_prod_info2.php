<?php
include 'includes/db.php';?>
<!DOCTYPE html>
<html>
<head>
<?php include 'includes/head.php' ?>
</head>

<body class="skin-default">
<div class="preloader">
    <div class="loader_img"><img src="img/loader.gif" alt="loading..." height="64" width="64"></div>
</div>
<!-- header logo: style can be found in header-->
<?php include 'includes/header.php' ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
<?php include 'includes/menu.php' ?>
<aside class="right-side">


    <!-- Main content -->
    <section class="content">

        <div class="content-wrapper animatedParent animateOnce">
<div class="container" >

<div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>FORMULA PACKING INFORMATION</i></b></h2><br>
</div>
   <div class="row" >
    <div class="col-md-11">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Formula Packing Information</span>
         </strong>
        </div>
        <div class="panel-body">
<form method="post" >

<div class="col-md-6"><div class="form-group">
      <label><b>    Name</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-md" name="packing"  placeholder=" Name" required>
</div></div>


 <div class="col-md-6">
  <div class="form-group">
    
       <label><b>Chose Formula </b><span class="text-danger">*</span></label>
<select name="formula" id="formula" class="form-control input-md select2 " onchange ="get_product(1)" required>
         <option value="">Choose</option>
          <optgroup >
              <?php
               $query4="SELECT * FROM formula_grand";
               $db4=mysqli_query($connection,$query4);
               while ($row4=mysqli_fetch_array($db4)) {?>
                 <option value="<?php echo $row4['formula_name']; ?>"> <?php echo $row4['formula_name']; ?> </option>
               <?php }
              ?> 
          </optgroup> 
      </select>
  </div>
</div>

<div class="col-md-6"><div class="form-group">
      <label><b>Weight (KG)  </b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-md" name="quantity"  placeholder="Quantity In Gram/-" required>
</div></div>

 <div class="col-md-6">
  <div class="form-group">
    
       <label><b>Chose Group </b><span class="text-danger">*</span></label>
<select name="group" id="select2" class="form-control input-md select2 " required>
         <option value="">Choose</option>
          <optgroup >
              <?php
               $query4="SELECT * FROM groups";
               $db4=mysqli_query($connection,$query4);
               while ($row4=mysqli_fetch_array($db4)) {?>
                 <option value="<?php echo $row4['id']; ?>"> <?php echo $row4['title']; ?> </option>
               <?php }
              ?> 
          </optgroup> 
      </select>
  </div>
</div>
<table>
<tr>
<?php
$id=0;

$query4="SELECT * FROM packings";
$db4=mysqli_query($connection,$query4);
$num=mysqli_num_rows($db4);
while ($row4=mysqli_fetch_array($db4)) { 

 $packid=$row4['id'];   ?>
  
  <td>
<div class="col-md-12" id="my">
<div class="form-group">
<input type="checkbox" name="check_list[]" onchange="callme(<?php echo $row4['id']; ?>)"  class="check"  id="checkbox<?php echo $row4['id'];?>" value="<?php echo $row4['id'];?>">
<span><?php echo $row4['name'];?></span><br>
<?php
$query5="SELECT * FROM packings WHERE id ='$packid' ";
$db5=mysqli_query($connection,$query5);
while ($row5=mysqli_fetch_array($db5)) {?>
    <div class="ch">
   <input type="hidden" name="text" class="txt" id="code<?php echo $id; ?>"  size="5" value="<?php echo $row5['code'] ;?>"><br> 
    <span>Quantity</span>
    <input type="text" name="text" size="5" class="txt" id="quantity<?php echo $id; ?>" value="<?php echo $row5['quantity'] ;?>"><br>
    <span>Un.Price</span>
    <input type="text" name="text" size="5" class="txt" id="price<?php echo $id;?>" value="<?php echo $row5['price'] ;?>" >

<input type="hidden"  name="row"  id="net_price"  class="form-control input-sm">

  </div><br>

</div>
</div>
</td>
<?php  $id++; } }?>

</tr>
</table>
<div class="col-md-6"><div class="form-group">
      <label><b> Cost Per Unit (Rs):</b><span class="text-danger">*</span></label>
<input type="text"  name="costper"   id="costper"  class="form-control input-md">
</div>
</div>




<div class="col-md-6"><div class="form-group">
      <label><b>  Sale Price (Rs)</b><span class="text-danger">*</span></label>
<input type="text"     name="saleper"  id="saleper"   class="form-control input-md">
</div></div>

<br>

<div  align="center">
<input type="submit" name="save" id="save" value="Save" class="btn btn-primary btn-md">
<a href="index.php" class="btn btn-danger  btn-md ">CANCEL </a>
</div>
        </form>
        </div>
      </div>
    </div>


   </div>
   </div>
</div>

<?php include 'includes/right-menu.php' ?>
    <!-- /.right-side -->
</div>
<!-- /.right-side -->
<!-- ./wrapper -->
<!-- global js -->
<script src="js/app.js" type="text/javascript"></script>
<script src="vendors/select2/js/select2.js" type="text/javascript"></script>

<!-- end of page level js -->
</body>
</html>



<script type="text/javascript">
  function get_product(id)
{
   var product=$('#formula').find(':selected').val();
    
        $.ajax({
        type : 'POST',
        url : 'get_formula_info.php',
        dataType:"json",
        data  : {product_id:product},
        success : function (data)
            {              
                 prici=$('#costper').val(data.price);
                 // console.log(prici);
            }
   });
}         
</script>



<script type="text/javascript">
var total=0;  var net_price=0;
function callme(id){
     $.ajax({
           url:'get_packing_info.php',
           type:'GET',
           dataType:'json',
           data:{'id':id},
        success:function(data){
        net_price=$('#net_price').val(data.price);

if( document.getElementById("checkbox"+id).checked = true){
// if($("#checkbox"+id).prop('checked')){

     total+= $('#net_price').val();
 } 

  else if( document.getElementById("checkbox"+id).checked = false)   { 
      total-= $('#net_price').val();
        }
        var geti=$('#costper').val();
         var fin= +total+ +geti;
           $('#saleper').val(fin);
    
    }

  });
}




  // var checkBox = document.getElementById("checkbox"+id);

  // if (checkBox.checked == true){
  //   total+= $('#net_price').val();
  //    alert(total);
  // } else {
  //   total-= $('#net_price').val();
  //    alert(total);
  // }







//    if( document.getElementById("checkbox"+id).checked = true){
//      total+= $('#net_price').val();
//      // alert("checked");
//       var geti=$('#costper').val();
//         var fin= +total+ +geti;
//           $('#saleper').val(fin);
// }


//    else{
//       total -=$('#net_price').val();
//       alert("unchecked");
//          var geti=$('#costper').val();
//            var fin= +total + +geti;
//             $('#saleper').val(fin);
// }




// $('input:checkbox').on('change', function() {
//     if (this.checked)
//         $total += +this.value;
//     else
//         $total -= +this.value;

//     $('#total').html($total);
// });

      
// if($("#checkbox"+id).prop('checked'))
// {
//         total+= $('#net_price').val();
//        // alert(total);
        
// }
// else {

//         // var minus=$("#checkbox"+id).val();
//         total -=$('#net_price').val();
//        // alert(total);
        
//         if(total<0){
       
//        total=0
//         }


//       }
      






//  function  get_pack(id){
//   $("input:checkbox[name=type]").each(function() {
//   var count=0;
// var count=$('#check_list'+id).val();
// console.log(count);
//        $.ajax({
//       url:'ajax_pack_prod_info.php',
//       type:'get',
//       data:{'count':count
//    },
//       success(data){
//       $('#costper').val(data);
//       }
//    }); 
//     });
//   }
</script>




<?php
if(isset($_POST['save'])){//to run PHP script on submit
if(!empty($_POST['check_list'])){
// Loop to store and display values of individual checked checkbox.
foreach($_POST['check_list'] as $selected){
echo $selected."</br>";
}
}
}
?>







<?php
// if (isset($_POST['save'])) {
//       $title = $_POST['packing'];
//     $formula = $_POST['formula'];
//     $code = $_POST['code'];
//     $quantity = $_POST['quantity'];
//     $price = $_POST['price'];
//     $product = $_POST['product'];
//     $group = $_POST['group'];
//     $type = $_POST['optradio'];


//     $total=$quantity*$price;

// $query ="INSERT INTO `packings`( `name`, `quantity`, `price`,`code`, `type`, `formula_id`, `group_id`)
//          VALUES  ('$title','$quantity','$price','$code','$type','$formula','$group')";
//     $result = mysqli_query($connection, $query);
//     if($result){
//    echo' <script>window.location.href = "add_packing.php";</script>';
// }
//    }
?>



<?php
// if (isset($_GET['id'])) {
//     $id=$_GET['id'];
// $que2="DELETE FROM `packings` WHERE id='$id'";
// $res2=mysqli_query($connection,$que2);
// if($res2){
//    echo' <script>window.location.href = "add_packing.php";</script>';
// }
// }
?>

<script type="text/javascript">
// document.onkeyup = function(e) {
// if (e.which == 13) {
//   document.getElementById("save").click();
// }
// if (e.which == 27) {
// window.location.href = "index.php";
// }
// };
</script>
<script type="text/javascript">
  $(document).ready(function(){

    $(".select2").select2({
            theme: "bootstrap",
            placeholder: "Select"
        });
});


</script> 
