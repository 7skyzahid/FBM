<?php
include 'includes/db.php';
?>
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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>PACKING INFORMATION</i></b></h2><br>
</div>
   <div class="row" >
    <div class="col-md-10">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Packing Information</span>
         </strong>
        </div>
        <div class="panel-body">
<form method="post" >
<div class="row" >
<div class="col-md-6"><div class="form-group">
      <label><b>    Name</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="packing"  placeholder=" Name" required>
</div></div>

<div class="col-md-6"><div class="form-group">
      <label><b>  Code</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="code"  placeholder=" Code" required>
</div></div>

</div>


<div class="row" >

 <div class="col-md-6">
  <div class="form-group">
    
       <label><b>Chose Formula </b><span class="text-danger">*</span></label>
<select name="formula" id="select2" class="form-control select2 " required>
         <option value="">Choose</option>
          <optgroup >
              <?php
               $query4="SELECT * FROM formula";
               $db4=mysqli_query($connection,$query4);
               while ($row4=mysqli_fetch_array($db4)) {?>
                 <option value="<?php echo $row4['id']; ?>"> <?php echo $row4['name']; ?> </option>
               <?php }
              ?> 
          </optgroup> 
      </select>
  </div>
</div>

<div class="col-md-6"><div class="form-group">
      <label><b>Wight </b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="quantity"  placeholder="Quantity In Gram/-" required>
</div></div>
</div>

<div class="row" >

 <div class="col-md-12">
  <div class="form-group">
    
       <label><b>Chose Group </b><span class="text-danger">*</span></label>
<select name="place"  id="place"class="form-control select2 " required>
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
 </div>

<table class="table table-sm">
<tr id="subjectDiv"  class="table-primary">



</tr>
</table>
<div class="row" >
<div class="col-md-4"><div class="form-group">
      <label><b> Cost Per Unit (Rs):</b><span class="text-danger">*</span></label>
<input type="text"  name="costper"  id="costper"  class="form-control input-sm">

</div></div>

<div class="col-md-4"><div class="form-group">
      <label><b>  Sale Price (Rs)</b><span class="text-danger">*</span></label>
<input type="text"     name="saleper"  id="saleper"   class="form-control input-sm">
</div></div>

</div>
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


<script>
$(document).ready(function(){
$('#place').change(function(){
   var palace =$('#place').val();
    console.log(palace);
  $.ajax({
    url:'ajax_pack_prod_info.php',
    type:'POST',
    data:{
        'place':palace
    },   
    success:function(result){
      console.log(result);
        $('#subjectDiv').html(result);
       
    }
  });
});
});
</script>




<script type="text/javascript">


// $("[type=checkbox]").each(function() {
//     if($(this).is(':checked')){
//         alert($(this).closest('div.check').find("input[type=text]").val());
//     }
// });


   $('.check').change(function(){

var val=$(this).val();
var that=$(this);
 var checkbox="#checkbox"+val;



        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
          
        var my=val[i];
       var sum=0; 

       var cost=0;
         $.ajax({
           url:'get_packing_info.php',
           type:'GET',
           dataType:'json',
           data:{'id':my},
       
        success:function(data){
     
        var net_price=$('#net_price').val(data.price);

        var tot=$(net_price).val();
        $('#net_price').val(tot);
        calculate_grand_total();
        
         
function calculate_grand_total()
        {
            var grand_total_amount = 0;
            $("input[name^='row']").each(function () {
               var total_amount_input = $(this).val();


                  //Note :: try with parseInt or pareseFloat
                grand_total_amount += parseFloat($(total_amount_input).val());
               console.log(total_amount_input);


            
            });



               // console.log(grand_total_amount);

            // Number($('#grand_total_amount').val(grand_total_amount));


        }                


        }





         });


  
           

        });






//     if($(checkbox).prop('checked'))
// {                

//           var inp=$('#my').find('div.txt').html();
          
//        console.log(inp)
                 

//                   }          
 
          

});



 function  get_pack(id){
  $("input:checkbox[name=type]").each(function() {

  var count=0;
var count=$('#check_list'+id).val();
console.log(count);

       $.ajax({
      url:'ajax_pack_prod_info.php',
      type:'get',
      data:{'count':count


    },

      success(data){
      $('#costper').val(data);
      }
   }); 

    });

  }

</script>

<script type="text/javascript">
  $(document).ready(function(){

    $(".select2").select2({
            theme: "bootstrap",
            placeholder: "Select"
        });
});


</script> 
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




<script>





// $("#check_list").change(function() {
//     if(this.checked) {


//   var count=0;
// var count=$('#check_list').val();
// console.log(count);
//        $.ajax({
//       url:'ajax_pack_prod_info.php',
//       type:'get',
//       data:{'count':count},

//       success(data){
//       $('#costper').val(data);
//       }
//    });



        
//     }
// });





// var count=0;
// var count=$('#check_list').val();
//    $.ajax({
//       url:'ajax_pack_prod_info.php',
//       type:'get',
//       data:{'count':count},
//       success(data){
//       $('#costper').val(data);
//       }
//    });


// var selected = new Array();

// $(document).ready(function() {

//   $("input:checkbox[name=type]:checked").each(function() {
//        selected.push($(this).val());

//   });

// });




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

