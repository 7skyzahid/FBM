<?php
include 'includes/db.php';
$output="";
if(isset($_GET['count']))
{
    $count = $_GET['count'];
    $output .= '<div class="col-md-1"></div>';
    $output .= '<div class="col-md-11" id="row'.$count.'">
               <input type="hidden"  name="row[]" value="'.$count.'" id="total_fields">';
    $output .= '<div class="col-md-2"> <br>
                <select  id="finished_products'.$count.'" name="finished_products[]" class="form-control select2" style="width:100%">
                <option value="0">Choose</option>';
                $select_f = "SELECT * FROM finished_products";
                $run_f = mysqli_query($connection,$select_f);
                while($row = mysqli_fetch_array($run_f))
                {
                    $id = $row['id'];
                    $name2 = $row['product_name'];
                    
                    $output.='<option value="'.$id.'">'.$name2.'</option>';
                };
    $output .='</select></div>';


    $output .='<div class="col-md-2"> <br>
                <select  id="packings'.$count.'" name="packings[]" class="form-control select2" style="width:100%">
                <option value="0">Choose</option>';
                $select_p = "SELECT * FROM packings";
                $run_p = mysqli_query($connection,$select_p);
                while($row = mysqli_fetch_array($run_p))
                {
                  $id = $row['id'];
                  $name3 = $row['packing_name'];
                  
                  $output.='<option value="'.$id.'">'.$name3.'</option>';
                };
    $output .='</select></div>';


    $output.='<div class="col-md-2"> <br>
                <input type="text" name="price[]" id="price'.$count.'" class="form-control" >
                
                
            </div>

            <div class="col-md-2"><br>
                <input type="number" name="qunatity[]"   value="1"  id="qunatity'.$count.'" class="form-control">
            </div>

            <div class="col-md-2">                             
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