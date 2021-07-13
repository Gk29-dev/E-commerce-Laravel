<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">


    <!-- Title Page-->
    <title>@yield('title')</title>

   

    <!-- Fontfaces CSS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="{{asset('admin_assets/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('admin_assets/css/theme.css')}}" rel="stylesheet" media="all">
  

</head>

<body>


<div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="dashboard">
                            <img src="{{asset('admin_assets/images/icon/logo.png')}}" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider navbar-toggler" data-toggle="collapse"  data-target="#collapsibleNavbar" type="button" style="background-color: black;">
                            <span class="hamburger-box navbar-toggler-icon"><i class="fas fa-arrow-down" style="color:white;"></i>
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile collapse navbar-collapse" id="collapsibleNavbar">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub @yield('dashboard')">
                            <a  href="{{route('dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="@yield('category')">
                            <a href="{{route('category')}}">
                                <i class="fas fa-chart-bar"></i>Category</a>
                        </li>

                        <li class="@yield('product')">
                            <a href="{{route('product')}}">
                                <i class="fas fa-chart-bar"></i>Product</a>
                        </li>

                        <li class="@yield('brand')">
                            <a  href="{{route('Brand')}}">
                                <i class="fas fa-tachometer-alt"></i>Brand</a>
                        </li>

                        <li class="@yield('customer')">
                            <a  href="{{route('customer')}}">
                                <i class="fas fa-user"></i>Users</a>
                        </li>
                      
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('admin_assets/images/icon/logo.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="@yield('dashboard')">
                            <a  href="{{route('dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="@yield('category')">
                            <a href="{{route('category')}}">
                                <i class="fas fa-list-alt"></i>Category</a>
                        </li>

                        <li class="@yield('product')">
                            <a href="{{route('product')}}">
                                <i class="fab fa-product-hunt"></i>Product</a>
                        </li>

                        <li class="@yield('brand')">
                            <a  href="{{route('Brand')}}">
                                <i class="fas fa-tachometer-alt"></i>Brand</a>
                        </li>

                        <li class="@yield('customer')">
                            <a  href="{{route('customer')}}">
                                <i class="fas fa-user"></i>Users</a>
                        </li>

                        <li class="@yield('orders')">
                            <a  href="{{route('showOrder')}}">
                                <i class="fa fa-shopping-cart"></i>Order</a>
                        </li>

                        <li class="@yield('banner')">
                            <a  href="{{route('Banner')}}">
                                <i class="fas fa-images"></i>Home Banner</a>
                        </li>
    
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                              
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Welcome, Admin</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{route('logout')}}">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">@yield('heading')</h2>
                                    @yield('add-category-btn')
                                </div>
                            </div>
                        </div>


                        <!----Main Content Starts Here---->
                        @yield('main-content')

                        
                        <!----Main Content Ends Here---->

                       
                        
                       
                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Design By Gaurav</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
    <!-- Jquery JS-->
    <script src="{{asset('admin_assets/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/wow/wow.min.js')}}"></script>


    <!-- Main JS-->
    <script src="{{asset('admin_assets/js/main.js')}}"></script>

</body>

</html>
<!-- end document-->