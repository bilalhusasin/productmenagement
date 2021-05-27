<!DOCTYPE html>
<html lang="en" >
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title> </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="BFTech" name="author"/>

        <!--Base tag start-->
        <base href="<?php echo $this->config->base_url(); ?>">
        <!--Base tag end-->

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link href="assets/global/css/components.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout/css/layout.min.css" rel="stylesheet" type="text/css"/>
        <link id="style_color" href="assets/admin/layout/css/themes/default.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link id="favicon" rel="shortcut icon" href=" " type="image/png"/>

        <script src="assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>

    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="page-header-fixed page-quick-sidebar-over-content page-header-fixed-mobile page-footer-fixed1">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top" style="background-color: gray; !important;">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                     
                    <div class="menu-toggler sidebar-toggler hide">
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                </a>
                <!-- End RESPONSIVE MENU TOGGLER -->
                <?php
                $user = $this->ion_auth->user()->row();
                $userId = $user->id;
                ?>
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                         
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <li class="dropdown dropdown-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                 
                                <span class="username">
                                    <?php echo $user->username; ?> </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                   
                                <li>
                                    <a href="index.php/auth/logout">
                                        <i class="icon-key"></i>Logout</a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <div class="clearfix">
        </div> 
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler">
                            </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <li>
                            &nbsp;
                        </li>
                        <!-- <li class="">
                            <a href="index.php/home/index">
                                <i class="icon-home"></i>
                                <span class="title"> Dashboard </span>
                                <span class="selected"></span>
                            </a>
                        </li> -->
                        
                            <li class="nav-item ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-group"></i>
                                    <span class="title">Products</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                     
                                    <li class="nav-item ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <span class="title">Product Categories</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu"> 
                                            <li class="nav-item ">
                                                <a href="index.php/products/addCategory" class="nav-link ">
                                                    <span class="title">Add Category</span>
                                                </a>
                                            </li> 
                                            <li class="nav-item">
                                                <a href="index.php/products/allCategory" class="nav-link ">
                                                    <span class="title">All category</span>
                                                </a>
                                            </li>  
                                        </ul>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <span class="title">Products</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu"> 
                                            <li class="nav-item ">
                                                <a href="index.php/products/addProduct" class="nav-link ">
                                                    <span class="title">Add Products</span>
                                                </a>
                                            </li> 
                                            <li class="nav-item">
                                                <a href="index.php/products/allProducts" class="nav-link ">
                                                    <span class="title">All Products</span>
                                                </a>
                                            </li>  
                                        </ul>
                                    </li>
                                </ul> 
                                    
                         
                            <li class="nav-item ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-eye"></i>
                                    <span class="title">HRM</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                    <!--this ul li section add groups title --> 
                                    <li class="nav-item">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <span class="title"> User Groups</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu"> 
                                                <li class="nav-item ">
                                                    <a href="index.php/users/addGroup" class="nav-link ">
                                                        <span class="title"> Add User Group</span>
                                                    </a>
                                                </li>
                                            
                                        </ul>
                                    </li> 
                                    <li class="nav-item ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <span class="title">Employee Management</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu"> 
                                            <li class="nav-item <?php echo $addNewUsers; ?>">
                                                <a href="index.php/users/addNewUsers" class="nav-link ">
                                                    <span class="title"> Add Employee </span>
                                                </a>
                                            </li> 
                                            <li class="nav-item ">
                                                <a href="index.php/users/allUserInafo" class="nav-link ">
                                                    <span class="title"> Employee List</span>
                                                </a>
                                            </li> 
                                        </ul>
                                    </li> 
                                     
                                </ul>
                            </li>  
                        <li class="heading">
                            <h3 class="uppercase"> Logout</h3>
                        </li>
                        <li class="nav-item">
                            <a href="index.php/auth/logout" class="nav-link">
                                <i class="fa fa-power-off"></i>
                                <span class="title"> Logout</span>
                            </a>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </div>
            <!-- END SIDEBAR -->
