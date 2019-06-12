<?php  include 'includes/db.php'; ?>

<?php
$output="";
if(isset($_GET['count']))
 {
  $count= $_GET['count'];

   
    $output .='<div class="col-md-12" id="row'.$count.'">
               <div  class="row" style="margin-left: 20px">
        <input type="hidden"  name="row[]" value="'.$count.'" id="total_fields">';
    $output .='
     <div class="col-xs-4"><br>
        <select name="employee[]" id="employee'.$count.'"  class="form-control select2" style="width:100%">
   <option value="">Choose Employee</option>';

$items = mysqli_query($connection, "SELECT * FROM employees");
while ($row7=mysqli_fetch_array($items)) {
   $emp_id=$row7['id']; 
 $empl=$row7['name'];
  $output.='<option value="'.$emp_id.'">'  .$empl.  '</option>';
} ;
$output .='</select></div>';

$output.='

<div class="col-xs-4">
<br>
<input type="text" name="quantity[]" id="quantity'.$count.'" class="form-control" placeholder="Quantity ">
</div>


<div class="col-xs-1">                            
  <button type="button" onclick="remove_item('.$count.')" class="btn btn_3d button-royal pull-right btn-icon  btn-round m-r-50"> <i class="icon fa fa-fw ti-minus" aria-hidden="true"></i></button>
</div>

</div>
</div>';


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
         