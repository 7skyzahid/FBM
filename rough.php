<script type="text/javascript">

var total=0;
var net_price=0;


function callme(id){
     $.ajax({
           url:'get_packing_info.php',
           type:'GET',
           dataType:'json',
           data:{'id':id},
       
        success:function(data){
       // net_price=$('#net_price').val(data.price.toFixed(3));
        net_price=$('#net_price').val(data.price);

       console.log(net_price);
      
if($("#checkbox"+id).prop('checked'))
{
        total+= $('#net_price').val();
       // alert(total);
        
}
else {

        // var minus=$("#checkbox"+id).val();
        total -=$('#net_price').val();
       // alert(total);
        
        if(total<0){
       
       total=0
        }


      }
       var geti=$('#costper').val();
     var toti=$('#net_price').val();
   var fin= +toti+ +geti;
    $('#costper').val(fin);
    }
  });
   

}