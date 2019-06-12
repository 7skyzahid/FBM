<?php
include 'includes/db.php';
$output="";
if(isset($_GET['count']))
 {
  $count= $_GET['count'];

   
    $output .='<div class="col-md-12" id="row'.$count.'">
                     <div  class="row" style="margin-left: 10px">
        <input type="hidden"  name="row[]" value="'.$count.'" id="total_fields">';
    $output .='
     <div class="col-xs-2"><br>
        <select name="product[]" id="pro'.$count.'"  class="form-control select2" style="width:100%">
   <option value="0">Choose</option>';

$items = mysqli_query($connection, "SELECT * FROM materials");
while ($row7=mysqli_fetch_array($items)) {
  $product_id=$row7['id']; 
 $product_title=$row7['title'];

         $output.='<option value="'.$product_id.'">'  .$product_title.  '</option>';

} ;
$output .='</select></div>';


$output .='
     <div class="col-xs-2"><br>
        <select name="packing[]" id="pack'.$count.'"  class="form-control select2" style="width:100%">
   <option value="0">Choose</option>';

$items = mysqli_query($connection, "SELECT * FROM materials");
while ($row7=mysqli_fetch_array($items)) {
  $product_id=$row7['id']; 
 $product_title=$row7['title'];

         $output.='<option value="'.$product_id.'">'  .$product_title.  '</option>';

} ;
$output .='</select></div>';



$output.='
<div class="col-xs-2">
<br>
<input type="text" name="pur_price[]" id="price'.$count.'" class="form-control" placeholder="Purchase Price">
</div>


<div class="col-xs-2">
<br>
<input type="text" name="discount[]" onkeyup="Caldiscount('.$count.')" id="discount'.$count.'" class="form-control" placeholder="Discount %">
</div>

<div class="col-xs-2">
<br>
<input type="text"  name="cpdisc[]" onkeyup="Calcpdiscount('.$count.')" id="cpdisc'.$count.'" class="form-control" placeholder="Discount Value">
</div>

<div class="col-xs-2">
<br>
<input type="text"  name="bonous[]"  id="bonous'.$count.'" class="form-control" placeholder="Bonus">
</div>


<input type="hidden" name="dumy1[]"  id="frstdumy'.$count.'">
<input type="hidden" name="dumy2[]"  id="secdumy'.$count.'">

<input type="hidden" name="prc[]"  id="prc'.$count.'" class="form-control" readonly>
</div>








<div class="row" style="margin-left: 10px"  >

<div class="col-xs-2">
<br>
<input type="text" name="saletax[]" id="saletax'.$count.'"   class="form-control" placeholder="Sale Tax">
</div>

<div class="col-xs-2">
<br>
<input type="text" name="minstock[]" id="minstock'.$count.'"  class="form-control"  placeholder="Min Stock">
</div>

<div class="col-xs-2">
<br>
<input type="text" name="maxstk[]" id="maxstk'.$count.'"  class="form-control" placeholder="Max Stock">
</div>

<div class="col-xs-2">
<br>
<input type="text" name="quantity[]" id="quantity'.$count.'" onkeyup="changeQuantity('.$count.')" class="form-control" placeholder="Quantity P">
</div>

<div class="col-xs-2">
<br>
<input type="text" name="lose[]" id="lose'.$count.'"  class="form-control" placeholder="Quantity L">
</div>

<div class="col-xs-2">
<br>
<input type="text" name="total[]" id="total'.$count.'" class="form-control" readonly>
</div>




        
    <div class="col-xs-1">                            
  <button type="button" onclick="remove_item('.$count.')" class="btn btn_3d button-royal pull-right btn-icon  btn-round m-r-50"> <i class="icon fa fa-fw ti-minus" aria-hidden="true"></i></button>
</div>

    </div>
   </div>

</div>
<br>';  

echo $output;
  }
?>

<script src="js/autosearch/bootstrap3-typeahead.min.js"></script> 
<script type="text/javascript">
  $(document).ready(function(){

    $(".select2").select2({
            theme: "bootstrap",
            placeholder: "Select"
        });
});


</script>
         