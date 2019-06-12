<!DOCTYPE html>
<html>
<head>
<?php include 'includes/head.php' ?>
<?php include 'includes/db.php' ?>
</head>

<body class="skin-default">

<?php include 'includes/header.php' ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php include 'includes/menu.php' ?>
<br><br><br><br>
<aside style="margin-left: 15%">
       <section class="content p-l-r-15">
        <div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>USER INFORMATION</i></b></h2><br>
</div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <i class="ti-user"></i> Users List
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table">
                                    <thead>
                                    <tr class="filters">
                                        <th>User Type</th>
                                        <th>User E-mail</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
<?php 
$query=mysqli_query($connection,"SELECT * FROM users");
while ($row=mysqli_fetch_array($query)) {?>
    


                                    <tbody>
                                    <tr>
                                        <td><?php echo $row['type'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['created_at'];?></td>
                                        
                                        <td style="text-align: center;">
                                            <a href="update_user.php?update=<?php echo $row['id'];?>"><i
                                                class="fa fa-fw ti-pencil text-primary actions_icon"
                                                title="Edit User"></i></a>&nbsp;&nbsp;&nbsp;
                                                <button type="button" onclick="delete_user(<?php echo $row['id'];?>)"
                                               
                                                ><i
                                                class="fa fa-fw ti-close text-danger actions_icon"
                                                title="Delete User"></i>
                                        </button></td>
                                    </tr>
                         
                                    </tbody>
                                <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="Heading"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                    </button>
                                    <h4 class="modal-title custom_align" id="Heading">Delete User</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-warning">
                                        <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to
                                        delete this Account?
                                    </div>
                                </div>
                                <div class="modal-footer ">
                                    <a  class="btn btn-danger delete">
                                        <span class="glyphicon glyphicon-ok-sign"></span> Yes
                                    </a>
                                    <button type="button" class="btn btn-success" data-dismiss="modal">
                                        <span class="glyphicon glyphicon-remove"></span> No
                                    </button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
            <!-- row-->
            <!--rightside bar -->
            <div id="right">
                <div id="right-slim">
                    <div class="rightsidebar-right">
                        <div class="rightsidebar-right-content">
                            <div class="panel-tabs">
                                <ul class="nav nav-tabs nav-float" role="tablist">
                                    <li class="active text-center">
                                        <a href="#r_tab1" role="tab" data-toggle="tab"><i
                                                class="fa fa-fw ti-comments"></i></a>
                                    </li>
                                    <li class="text-center">
                                        <a href="#r_tab2" role="tab" data-toggle="tab"><i class="fa fa-fw ti-bell"></i></a>
                                    </li>
                                    <li class="text-center">
                                        <a href="#r_tab3" role="tab" data-toggle="tab"><i
                                                class="fa fa-fw ti-settings"></i></a>
                                    </li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="background-overlay"></div>
        </section>
    </aside>

        


<?php include 'includes/right-menu.php' ?>
    <!-- /.right-side -->
</div>



<script src="js/app.js" type="text/javascript"></script>
<!-- end of global js -->
<!-- begining of page level js -->
<script type="text/javascript" src="vendors/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="js/custom_js/users_custom.js"></script>
<!-- end of page level js -->
<script type="text/javascript">
    

function delete_user(id){

$('#delete').modal('show');    
        var el = this;

$('.delete').click(function(){

           $.ajax({
           url:'/project/ajax_delete.php',
           method:'POST',
           data:{'id':id},
           success(data){
               console.log(data);
               $(el).closest('tr').css('background','tomato');
               $(el).closest('tr').fadeOut(800,function(){
                   $(this).remove();
               });

               $('#delete').modal('hide');
                location.reload();
           }
           });

})
}
</script>


</body>


</html>