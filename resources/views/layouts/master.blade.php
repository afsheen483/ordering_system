<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>



   
</head>

<body>

    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="/dashboard" class="logo">
					<img src="../assets/img/logo.png" width="35" height="35" alt=""><span>Eye Care Supplies</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="../assets/img/user.jpg" width="24" alt="Admin">
							<span class="status online"></span>
						</span>
						<span>{{ Auth::user()->name }}</span>
                    </a>
					<div class="dropdown-menu">
						    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf   
                      </form>
					</div>
                </li>
            </ul>
            
        </div>
        
    
    @hasanyrole('admin|staff|receiver|vendor')

        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="active">
                            <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        @hasanyrole('admin|staff')
                        <li>
                            <a href="{{ route('orders.create') }}"><i class="fas fa-plus"></i><span>Add Lense Order</span></a>
                        </li>
                        @endhasanyrole
                        <li>
                            <a href="../orders-list/all"><i class="fal fa-bags-shopping"></i><span>Lens Orders</span></a>
                        </li>
                        @hasanyrole('admin|staff')
                        <li>
                            <a href="{{ route('frame_order.index') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Frames Order</span></a>
                        </li>
                        <li>
                            <a href="{{ route('inventory_adjustment.index')}}"><i class="fas fa-inventory"></i><span>Inventory Adjustment</span></a>
                        </li>
                        <li>
                            <a href="/cycle_amount_inventory"><i class="fa fa-sticky-note"></i><span>Cycle Amount Inventory</span></a>
                        </li>
                       
                        @endhasanyrole

                      
                        @hasanyrole('admin|vendor')
                        <li>
							<a href="../tracking_details"><i class="fa fa-shipping-fast"></i> <span>Shippment Details</span></a>
						</li>
						@endhasanyrole
                        <li class="submenu">
							<a href="#"><i class="fa fa-sticky-note"></i><span> Reports</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
							<li>
                                <a href="/orders-list/all" class="dropdown-item" name="all" class="all" id="btn-all"><span>All</span></a>
                            </li>
                            <li>
                                <a href="/orders-list/shipped" class="dropdown-item" name="shipped" class="shipped"
                                id="complete-btn">Shipped Items</a>
                            </li>
    						<li>
                                <a href="/orders-list/notshipped" class="dropdown-item" name="missing" class="missing"
                                id="missing-btn">Not Shipped</a>
                            </li>
                            <li>
                                <a href="/orders-list/received" class="dropdown-item" value="received" name="received"
                              id="hide">Receive Items</a>
                            </li>
                            <li>
                                <a href="/orders-list/missing" class="dropdown-item" value="unreceived" name="missing"
                              id="hide">Missing Items</a>
                            </li>
                            <li>
                                <a href="/orders-list/unpaid" class="dropdown-item">Unpaid Items</a>

                            </li>
                                <li>
                                    <a href="/orders-list/priority" class="dropdown-item">Next Priority Items</a>

                                </li>
                                
							</ul>
						</li>
						@hasrole('admin')
                        <li class="submenu">
							<a href="#"><i class="far fa-user"></i><span> User Management </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
							<li>
                            <a href="../users"><i class="fa fa-user"></i><span>Users</span></a>
                            </li>
    						<li>
                                <a href="../roles"><i class="fa fa-user"></i><span>Roles</span></a>
                            </li>
                            <li>
                            <a href="../permissions"><i class="fas fa-key"></i><span>Permissions</span></a>
                            </li>                            
                
							</ul>
						</li>
						@endhasrole
						@hasanyrole('admin|staff')
                        <li class="submenu">
							<a href="#"><i class="fas fa-cog"></i> <span> Settings </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
                                <li><a href="../prescription"><i class="fa fa-sticky-note"></i> <span>Prescritpion Type</span></a></li>
                                <li>
                                    <a href="../coating"><i class="fas fa-layer-group"></i><span>Coatings</span></a>
                                </li>
                                <li>
                                    <a href="../lens"><i class="fa fa-eye" aria-hidden="true"></i>
                                        <span>Lens Type</span></a>
                                </li>
                                <li>
                                    <a href="../frame"><i class="fa fa-glasses" aria-hidden="true"></i><span> Frame Models</span></a>
                                </li>
                                <li>
                                    <a href="/inventory_reports/all"><i class="fa fa-sticky-note"></i><span>Inventory Report</span></a>
                                </li>

                                <li>
                                    <a href="{{ route('clinic.index') }}"><i class="fas fa-clinic-medical"></i><span> Clinics</span></a>
                                </li> 
                                
                       
								
							</ul>
						</li>
						@endhasrole
						<li>
						
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i><span>
                            {{ __('Logout') }}</span>
                            
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf   
                      </form>
                         
						</li>
						
						
                    </ul>
                </div>
            </div>
        </div>
        @endhasanyrole

      
        
        
        @hasanyrole('vendor|staff')


        
                        @hasrole('vendor')
                        
						<li>
							<a href="../shippment_orders"><i class="fa fa-shipping-fast"></i> <span>Shippment</span></a>
						</li>
						<li class="submenu">
							<a href="#"><i class="fas fa-cog"></i> <span> Settings </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
                                <li><a href="../prescription"><i class="fa fa-sticky-note"></i> <span>Prescritpion Type</span></a></li>
                                <li>
                                    <a href="../coating"><i class="fas fa-layer-group"></i><span>Coatings</span></a>
                                </li>
                                <li>
                                    <a href="../lens"><i class="fa fa-eye" aria-hidden="true"></i>
                                        <span>Lens Type</span></a>
                                </li>
								
							</ul>
						</li>
                        
                        @endhasrole
						
						
                    </ul>
                </div>
            </div>
        </div> 
        @endhasanyrole
        
     
        <div class="page-wrapper">
            <div class="content">
               @yield('content')
            </div>
            
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="../assets/js/jquery-3.2.1.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


@yield('scripts')
</body>


<!-- index22:59-->
</html>