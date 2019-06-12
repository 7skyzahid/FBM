<?php
include 'includes/db.php';
$output="";
if(isset($_GET['count']))
 {
	$count= $_GET['count'];
   
   
    $output .='<div class="col-md-12" id="row'.$count.'">
        <input type="hidden"  name="row[]" value="'.$count.'" id="total_fields">';
               

    $output.='<div class="col-md-2">
<br>
<input type="text" id="code'.$count.'" class="form-control input-sm" name="code[]"  placeholder="Code for Item" >
</div>';            

            $output .='
     <div class="col-md-2"><br>
<select name="item[]" id="item'.$count.'"  class="form-control input-sm select2" onchange ="get_product('.$count.')">
   <option value=""></option>';

$items = mysqli_query($connection, "SELECT * FROM materials");
while ($row7=mysqli_fetch_array($items)) {
$product_id=$row7['id']; 
$product_title=$row7['title'];
$output.='<option value="'.$product_id.'">'  .$product_title.  '</option>';

} ;
$output .='</select></div>';

        $output.='
<div class="col-md-2">
<br>
<input type="text" id="price'.$count.'" class="form-control input-sm" name="price[]"  placeholder="Price per Kilogram" required>
</div>

<div class="col-md-2">
<br>
<input type="text" id="quantity'.$count.'" class="form-control input-sm" name="quantity[]" onkeyup ="get_price('.$count.')" placeholder="Quantity In KG/-" required>
</div>



<div class="col-md-2">
<br>
<input type="text" id="total'.$count.'" class="form-control input-sm" name="total[]" readonly>
</div>


<div class="col-xs-2">         
<button type="button" onclick="remove_item('.$count.')" class="btn btn_3d button-royal pull-right btn-icon  btn-round m-r-50">
<i class="icon fa fa-fw ti-minus" aria-hidden="true"></i></button>
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
         
 
