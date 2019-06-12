

<?php 


// if($_SESSION['username']=='admin'){

// echo $_SESSION['username'];
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar-->
        <section class="sidebar">
            <div id="menu" role="navigation">
                <div class="nav_profile">
                    <div class="media profile-left">
                        <a class="pull-left profile-thumb" href="#">
                            <img src="./img/fbm.jpg" class="img-circle" alt="User Image"></a>
                        <div class="content-profile">
                            <h4 class="media-heading">FBM Brothers</h4>
                            
                        </div>
                    </div>
                </div>
<ul class="navigation">
    <li class="active" id="active">
        <a href="index.php">
            <i class="menu-icon ti-desktop"></i>
            <span class="mm-text ">Dashboard</span>
        </a>
    </li>
    <li>
<a href="add_production.php">
    <i class="menu-icon ti-layout-list-large-image"></i>
    <span class="mm-text ">New Production</span>
</a>
</li>
<li>
<a href="add_sales.php">
    <i class="menu-icon ti-layout-list-large-image"></i>
    <span class="mm-text ">Sale</span>
</a>
</li> 
 <li>
    <a href="add_package_sales.php">
        <i class="menu-icon ti-layout-list-large-image"></i>
        <span class="mm-text ">Package Sale</span>
    </a>
</li> 
 <li>
    <a href="add_purchase.php">
        <i class="menu-icon ti-layout-list-large-image"></i>
        <span class="mm-text "> Raw Material Purchase</span>
    </a>
</li>
 <li>
    <a href="add_packing_purchase.php">
        <i class="menu-icon ti-layout-list-large-image"></i>
        <span class="mm-text ">Raw Packing Purchase</span>
    </a>
</li>



<li class="menu-dropdown">
<a href="javascript:void(0)">
    <i class="menu-icon ti-calendar"></i>
    <span>Raw Materials</span>
    <span class="fa arrow"></span>
</a>
<ul class="sub-menu">
     <li>
        <a href="add_product.php">
            <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
            <span>Add Material</span>
            <small class="badge"></small>
        </a>
    </li>
    <!--  <li>
        <a href="add_raw_product.php">
            <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
            <span>Add Raw Product</span>
            <small class="badge"></small>
        </a>
    </li> -->
     <li>
        <a href="all_materials.php">
            <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
            <span>All  Materials</span>
            <small class="badge"></small>
        </a>
    </li>
     <li>
        <a href="bonus_report.php">
            <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
            <span> Bonus Products</span>
            <small class="badge"></small>
        </a>
    </li>
   
      <li>
        <a href="alert_product.php">
            <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
            <span>Min Quantity</span>
            <small class="badge"></small>
        </a>
    </li>
    <li>
        <a href="alert_zero.php">
            <i class=" menu-icon fa fa-fw ti-calendar"></i>
            <span>Zero Quantity </span>
            <small class="badge"></small>
        </a>
    </li>
</ul>
</li> 



 <li>
    <a href="all_stock_products.php">
        <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
        <span> Stock Products</span>
        <small class="badge"></small>
    </a>
</li>


<li class="menu-dropdown">
    <a href="javascript:void(0)">
        <i class="menu-icon ti-menu"></i>
        <span>
                Reports
            </span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
         <li>
            <a href="pack_sale_report.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">Package Sale Report</span>
            </a>
        </li>
        
  
    </ul>
</li>

 



           
 <li class="menu-dropdown">
    <a href="javascript:void(0)">
        <i class="menu-icon ti-menu"></i>
        <span>
                Sales Report
            </span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
         <li>
            <a href="return_sale.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">Return Sales</span>
            </a>
        </li>
        <li>
            <a href="sales_report.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">Sales By Date</span>
            </a>
        </li>
       
        <li>
            <a href="monthly_sales.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">Monthly Sales</span>
            </a>
        </li>
        <li>
            <a href="daily_sales.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">Daily Sales</span>
            </a>
        </li>
  
    </ul>
</li>






 
 <li class="menu-dropdown">
    <a href="javascript:void(0)">
        <i class="menu-icon ti-menu"></i>
        <span>
                Purchase Reports
            </span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="supp_in_stock.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">Supplier (In Stock) </span>
            </a>
        </li>
        <li>
            <a href="sup-without_stock.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">Supplier (All Report) </span>
            </a>
        </li>

        <li>
            <a href="com_in.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">Company (In Stock)</span>
            </a>
        </li>
        <li>
            <a href="com_out.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">Company (All Report)</span>
            </a>
        </li>
        
        <li>
            <a href="all_report.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">Over All Report</span>
            </a>
        </li>
        <li>
            <a href="bonus_report.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">Bonus Report</span>
            </a>
        </li>
    </ul>      
</li>



              
                <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-calendar"></i>
                            <span>Dues Report</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="dues_report_purchase.php">
                                    <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
                                    <span>Purchase Dues</span>
                                    <small class="badge"></small>
                                </a>
                            </li>
                            <li>
                                <a href="dues_by_date_purchase.php">
                                    <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
                                    <span>Pur Dues(By Date)</span>
                                    <small class="badge"></small>
                                </a>
                            </li>
                              <li>
                                <a href="dues_report_sales.php">
                                    <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
                                    <span>Sale Dues</span>
                                    <small class="badge"></small>
                                </a>
                            </li>
                            <li>
                                <a href="dues_by_date_sale.php">
                                    <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
                                    <span>Sale Dues(By Date)</span>
                                    <small class="badge"></small>
                                </a>
                            </li>

                        </ul>
                    </li>



<li class="menu-dropdown">
    <a href="javascript:void(0)">
        <i class="menu-icon ti-calendar"></i>
        <span>Saleman</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li>
    <a href="add_saleman.php">
        <i class="menu-icon ti-layout-list-large-image"></i>
        <span class="mm-text ">Add Saleman</span>
    </a>
    </li>
    <li>
        <a href="view_saleman.php">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">View Saleman</span>
        </a>
    </li>
    <li>
        <a href="stock_issue.php">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">Stock Issue To Saleman</span>
        </a>
    </li>
     <li>
        <a href="sale_policy.php">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">Sale Policy</span>
        </a>
    </li>

    </ul>
</li>



<li class="menu-dropdown">
    <a href="javascript:void(0)">
        <i class="menu-icon ti-menu"></i>
        <span>
                Warehouse
            </span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="add_warehouse.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text "> Add Warehouse</span>
            </a>
        </li>
         <li>
            <a href="view_warehouse.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">View Warehouse</span>
            </a>
        </li>
        <li>
            <a href="add_wh_transfer.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">Add Warehouse Transfer</span>
            </a>
        </li>
        <li>
            <a href="view_wh_transfer.php">
                <i class="menu-icon ti-layout-list-large-image"></i>
                <span class="mm-text ">View Warehouse Transfer</span>
            </a>
        </li>
       
    
    </ul>
</li>














    
<li class="menu-dropdown">
    <a href="javascript:void(0)">
        <i class="menu-icon ti-calendar"></i>
        <span>Expiry Report</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="months_expiry.php">
                <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
                <span>By Date</span>
                <small class="badge"></small>
            </a>
        </li>
        <li>
            <a href="current_expiry.php">
                <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
                <span>Current Month</span>
                <small class="badge"></small>
            </a>
        </li>
          <li>
            <a href="coming_year_expiry.php">
                <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
                <span>Comming Year</span>
                <small class="badge"></small>
            </a>
        </li>

    </ul>
</li>
     
    
    
                    
<li class="menu-dropdown">
    <a href="javascript:void(0)">
        <i class="menu-icon ti-calendar"></i>
        <span>Profit & Loss</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li>
    <a href="daily_profit.php">
        <i class="menu-icon ti-layout-list-large-image"></i>
        <span class="mm-text ">Daily Profit & Loss </span>
    </a>
    </li>

    <li>
        <a href="profit.php">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">Profit & Loss</span>
        </a>
    </li>

    </ul>
</li>


<li class="menu-dropdown">
<a href="javascript:void(0)">
    <i class="menu-icon ti-menu"></i>
    <span>
            Expenses 
        </span>
    <span class="fa arrow"></span>
</a>
<ul class="sub-menu">
    <li>
        <a href="expense_cat.php">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">Add Expenses Cat </span>
        </a>
    </li>
    <li>
        <a href="add_expense.php">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">Add Expenses</span>
        </a>
    </li>
    <li>
        <a href="view_expenses.php">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">View Expenses</span>
        </a>
    </li>
</ul>      
</li>
                  

<li class="menu-dropdown">
    <a href="javascript:void(0)">
        <i class="menu-icon ti-calendar"></i>
        <span>Package</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
         <li>
            <a href="add_package.php">
                <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
                <span>Add Package</span>
                <small class="badge"></small>
            </a>
        </li>
         <li>
            <a href="all_packages.php">
                <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
                <span>All  Packages</span>
                <small class="badge"></small>
            </a>
        </li>
       
       
    </ul>
</li>
                  
                  

 <li class="menu-dropdown">
<a href="javascript:void(0)">
<i class="menu-icon ti-settings"></i>
<span>Setting</span><span class="fa arrow"></span></a>
<ul class="sub-menu">


<li>
<a href="add_packing.php">
<i class="fa fa-fw ti-info"></i> Add Packing  
</a>
</li>

<li>
<a href="add_formula2.php">
<i class="fa fa-fw ti-info"></i> Add Formula  
</a>
</li>

<li>
<a href="add_group.php">
<i class="fa fa-fw ti-info"></i> Add Group  
</a>
</li>

<li>
<a href="add_category.php">
<i class="fa fa-fw fa-list-alt"></i>Add Category
</a>
</li>
<li>
<a href="add_unit.php">
<i class="fa fa-fw ti-plug"></i> Add Unit
</a>
</li>
<li>
<a href="add_size.php">
<i class="fa fa-fw ti-plug"></i> Add Size
</a>
</li>
<li>
<a href="add_employee.php">
<i class="fa fa-fw ti-info"></i> Add Employee  
</a>
</li>
<li>
<a href="add_employee_type.php">
<i class="fa fa-fw ti-info"></i> Add Emp Type  
</a>
</li>
<li>
<a href="add_salary.php">
<i class="fa fa-fw ti-info"></i> Add Salary  
</a>
</li>
<li>
<a href="add_department.php">
<i class="fa fa-fw ti-info"></i> Add Department  
</a>
</li>
<li>
<a href="add_company.php">
<i class="fa fa-fw ti-plug"></i> Add Company
</a>
</li>
<li>
<a href="add_supplier.php">
<i class="fa fa-fw ti-plug"></i> Add Supplier
</a>
</li>
</ul>
</li> 
                  
                    <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                         <i class="menu-icon ti-user"></i> <span>Users</span> <span
                                class="fa arrow"></span> </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="user_list.php">
                                    <i class="fa fa-fw ti-menu-alt" aria-hidden="true"></i> Users List
                                </a>
                            </li>
                            <li>
                                <a href="add_user.php">
                                    <i class="fa fa-fw ti-user"></i> Add New User
                                </a>
                            </li>
                            
                        </ul>
                    </li>




            <!--   <li class="menu-dropdown">
                        <a href="#">
                            <i class="menu-icon ti-calendar"></i>
                            <span>Alerts</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="">
                                    <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
                                    <span>Min Product</span>
                                    <small class="badge"></small>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class=" menu-icon fa fa-fw ti-calendar"></i>
                                    <span>Product Quanty Zero</span>
                                    <small class="badge"></small>
                                </a>
                            </li>
                        </ul>
                    </li>  -->


              <!--   <li class="menu-dropdown">
                        <a href="#">
                            <i class="menu-icon ti-calendar"></i>
                            <span>Calendar</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="calendar.html">
                                    <i class=" menu-icon fa fa-fw ti-video-clapper"></i>
                                    <span>Calendar</span>
                                    <small class="badge">7</small>
                                </a>
                            </li>
                            <li>
                                <a href="calendar2.html">
                                    <i class=" menu-icon fa fa-fw ti-calendar"></i>
                                    <span>Advanced Calendar</span>
                                    <small class="badge">6</small>
                                </a>
                            </li>
                        </ul>
                    </li> -->
 
                 
            
                </ul>
                <!-- / .navigation --> </div>
            <!-- menu --> </section>
        <!-- /.sidebar --> </aside>

<?php 
// }
// else{


//     echo "Your not an admin";
// }

?>